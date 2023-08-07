#!/bin/sh

set -e

if [ "$(id -u)" != "0" ]; then
	echo "You must be root to execute the script. Exiting."
	exit 1
fi

# check directory existing
DIR="/tmp/otikrd/"
if [ -d "$DIR" ]; then  
  #rm -rf /tmp/otikrd
  echo "Download otikrd package"
  #git clone https://github.com/npintong/otikrd.git
fi

sleep 1

echo 
echo "==========================================================="
echo "Change hostname to pbxsystem & TimeZone..."
echo "==========================================================="
echo 

sudo hostname otikrd

echo 
echo "==========================================================="
echo "Change TimeZone..."
echo "==========================================================="
echo 

sudo timedatectl set-timezone Asia/Bangkok

echo 
echo "==========================================================="
echo "Update Ubuntu System"
echo "==========================================================="
echo 
sudo apt update
sudo apt -y upgrade

echo 
echo "==========================================================="
echo "Install Apache Web Server"
echo "==========================================================="
echo 
sudo apt-get install apache2 php libapache2-mod-php php-mail php-mail-mime \
php-mysql php-gd php-common php-pear php-db php-mbstring \
php-xml php-curl unzip wget -y

sudo systemctl enable apache2
sleep 3

echo 
echo "==========================================================="
echo "Install Mariadb Server"
echo "==========================================================="
echo 

echo "installing..."
sudo apt install -y mariadb-server
sleep 1

echo "(Startup) Mariadb Server"
sudo systemctl enable mariadb
sleep 1

echo "(Start) Mariadb Server"
sudo systemctl start mariadb

sleep 1

mysql -u root < /tmp/otikrd/script.sql

echo 
echo "==========================================================="
echo "Build and Install Asterisk 18 on Ubuntu 20.04"
echo "==========================================================="
echo 
sudo apt-get install freeradius freeradius-mysql freeradius-utils -y

echo 
echo "====================================="
echo "Create soft link modules"
echo "====================================="
echo 

cd /etc/freeradius/3.0/mods-enabled/

sudo ln -s ../mods-available/sql ../mods-enabled/
sleep 1
sudo chgrp -h freerad ../mods-available/sql
sleep 1
sudo chown -R freerad:freerad ../mods-enabled/sql
sleep 1

echo "Enable SqlCounter"

sudo ln -s ../mods-available/sqlcounter ../mods-enabled/
sleep 1
sudo chgrp -h freerad ../mods-available/sqlcounter
sleep 1
sudo chown -R freerad:freerad ../mods-enabled/sqlcounter
sleep 1


sudo ln -s ../mods-available/linenotify ../mods-enabled/
sleep 1
sudo chgrp -h freerad ../mods-available/linenotify
sleep 1
sudo chown -R freerad:freerad ../mods-enabled/linenotify
sleep 1


echo 
echo "====================================="
echo "Install Web Management"
echo "====================================="
echo 

mv /tmp/otikrd/otikrd /var/www/html/
sleep 1
mv /tmp/otikrd/linenotify /usr/sbin/
sleep 1
chmod 755 /usr/sbin/linenotify
sleep 1

cat > /etc/freeradius/3.0/clients.conf << EOF
client localhost {
	
	ipaddr = 127.0.0.1

	proto = *

	secret = testing123

	require_message_authenticator = no

	nas_type	 = other

	limit {
		
		max_connections = 16

		lifetime = 0

		idle_timeout = 30
	}
}

client localhost_ipv6 {
	ipv6addr	= ::1
	secret		= testing123
}

client private-network {
	ipaddr		= 0.0.0.0/0
	secret		= Otik@Secret
}

EOF

sleep 1

cat > /etc/freeradius/3.0/mods-enabled/sql << EOF

######################################################################
#  Configuration for the SQL module
######################################################################

sql {

	dialect = "mysql"
	driver = "rlm_sql_\${dialect}"

	sqlite {
		filename = "/tmp/freeradius.db"
		busy_timeout = 200
		bootstrap = "\${modconfdir}/\${..:name}/main/sqlite/schema.sql"
	}

	mysql {
		warnings = auto
	}

	postgresql {
		send_application_name = yes
	}

	mongo {
		appname = "freeradius"
		tls {
			certificate_file = /path/to/file
			certificate_password = "password"
			ca_file = /path/to/file
			ca_dir = /path/to/directory
			crl_file = /path/to/file
			weak_cert_validation = false
			allow_invalid_hostname = false
		}
	}

	server = "localhost"
	port = 3306
	login = "otikuser"
	password = "Love@OtikNetWork"
	radius_db = "otikdb"
	acct_table1 = "tbl_master_radacct"
	acct_table2 = "tbl_master_radacct"

	postauth_table = "tbl_master_radpostauth"

	authcheck_table = "tbl_master_radcheck"
	groupcheck_table = "tbl_master_radgroupcheck"

	authreply_table = "tbl_master_radreply"
	groupreply_table = "tbl_master_radgroupreply"

	usergroup_table = "tbl_master_radusergroup"

	read_groups = yes

	read_profiles = yes

	delete_stale_sessions = yes

	query_timeout = 5

	pool {

		start = \${thread[pool].start_servers}

		min = \${thread[pool].min_spare_servers}

		max = \${thread[pool].max_servers}

		spare = \${thread[pool].max_spare_servers}

		uses = 0

		retry_delay = 30

		lifetime = 0

		idle_timeout = 60

	}

	read_clients = yes

	client_table = "tbl_master_nas"

	group_attribute = "SQL-Group"

	\$INCLUDE \${modconfdir}/\${.:name}/main/\${dialect}/queries.conf
}

EOF

sleep 1

cat > /etc/freeradius/3.0/radiusd.conf << EOF

prefix = /usr
exec_prefix = /usr
sysconfdir = /etc
localstatedir = /var
sbindir = \${exec_prefix}/sbin
logdir = /var/log/freeradius
raddbdir = /etc/freeradius/3.0
radacctdir = \${logdir}/radacct

name = freeradius
confdir = \${raddbdir}
modconfdir = \${confdir}/mods-config
certdir = \${confdir}/certs
cadir   = \${confdir}/certs
run_dir = \${localstatedir}/run/\${name}
db_dir = \${raddbdir}
libdir = /usr/lib/freeradius
pidfile = \${run_dir}/\${name}.pid
correct_escapes = true
max_request_time = 30
cleanup_delay = 5
max_requests = 16384
hostname_lookups = no

log {
	destination = files
	colourise = yes
	file = \${logdir}/radius.log
	syslog_facility = daemon
	stripped_names = no
	auth = no
	auth_badpass = no
	auth_goodpass = no
	msg_denied = "You are already logged in - access denied"
}

checkrad = \${sbindir}/checkrad

ENV {
	
}

security {
	user = freerad
	group = freerad
	allow_core_dumps = no
	max_attributes = 200
	reject_delay = 1
	status_server = yes
}

proxy_requests  = yes
\$INCLUDE proxy.conf

\$INCLUDE clients.conf

thread pool {
	
	start_servers = 5
	max_servers = 32
	min_spare_servers = 3
	max_spare_servers = 10
	max_requests_per_server = 0
	auto_limit_acct = no
}

modules {	
	\$INCLUDE mods-enabled/sql	
	\$INCLUDE mods-enabled/
}

instantiate {	
#	daily

}

policy {
	\$INCLUDE policy.d/
}

\$INCLUDE sites-enabled/


EOF

sleep 1

cat > /etc/freeradius/3.0/sites-available/default << EOF

server default {

listen {
	
	type = auth
	ipaddr = *
	port = 0
	limit {
	      
	      max_connections = 16
	      lifetime = 0
	      idle_timeout = 30
	}
}

listen {
	ipaddr = *
	port = 0
	type = acct

	limit {
	}
}

listen {
	type = auth
	ipv6addr = ::
	port = 0
	limit {
	      max_connections = 16
	      lifetime = 0
	      idle_timeout = 30
	}
}

listen {
	ipv6addr = ::
	port = 0
	type = acct

	limit {
	}
}

authorize {
	
	filter_username
	preprocess
	chap
	mschap
	digest
	suffix
	eap {
		ok = return
#		updated = return
	}

	files

	-sql

	-ldap
#	daily
	expiration
	logintime
	
	pap

}

authenticate {
	
	Auth-Type PAP {
		pap
	}

	Auth-Type CHAP {
		chap
	}

	Auth-Type MS-CHAP {
		mschap
	}

	mschap
	digest
	eap
}

preacct {
	preprocess
	acct_unique
	suffix
	files
}

accounting {
	
	detail
#	daily

	unix
	-sql

	exec
	attr_filter.accounting_response

}

session {
	sql
}

post-auth {
	
	if (session-state:User-Name && reply:User-Name && request:User-Name && (reply:User-Name == request:User-Name)) {
		update reply {
			&User-Name !* ANY
		}
	}
	update {
		&reply: += &session-state:
	}

#	main_pool
#	cui
#	sql_session_start
#	reply_log
	-sql
#	ldap

	# For Exec-Program and Exec-Program-Wait
#	exec

	if (ok) {
                update reply {
                        Reply-Message := "PASS"
                }
                line-notify-authen-pass
        }

#	wimax
	remove_reply_message_if_eap
	Post-Auth-Type REJECT {
		-sql
		attr_filter.access_reject
		eap
		remove_reply_message_if_eap
	}

	Post-Auth-Type Challenge {

	}

}

pre-proxy {
	
}

post-proxy {

	eap

}
}


EOF

sleep 1
systemctl restart freeradius
sleep 3

echo 
echo "====================================="
echo "Allow firewall 1812 , 1813 and 80"
echo "====================================="
echo 

sudo ufw allow proto tcp from any to any port 1812,1813,80
sleep 3

sudo chmod -x /etc/update-motd.d/*

echo 
echo "====================================="
echo "Create MOTD"
echo "====================================="
echo 

cat > /etc/motd << EOF


      ___           ___                       ___           ___           ___     
     /\  \         /\  \          ___        /\__\         /\  \         /\  \    
    /::\  \        \:\  \        /\  \      /:/  /        /::\  \       /::\  \   
   /:/\:\  \        \:\  \       \:\  \    /:/__/        /:/\:\  \     /:/\:\  \  
  /:/  \:\  \       /::\  \      /::\__\  /::\__\____   /::\~\:\  \   /:/  \:\__\ 
 /:/__/ \:\__\     /:/\:\__\  __/:/\/__/ /:/\:::::\__\ /:/\:\ \:\__\ /:/__/ \:|__|
 \:\  \ /:/  /    /:/  \/__/ /\/:/  /    \/_|:|~~|~    \/_|::\/:/  / \:\  \ /:/  /
  \:\  /:/  /    /:/  /      \::/__/        |:|  |        |:|::/  /   \:\  /:/  / 
   \:\/:/  /     \/__/        \:\__\        |:|  |        |:|\/__/     \:\/:/  /  
    \::/  /                    \/__/        |:|  |        |:|  |        \::/__/   
     \/__/                                   \|__|         \|__|         ~~       


Welcome to otikrd | By OtikNetwork
www.otiknetwork.com / 02-538-4378, 095-549-9819


EOF


# Congrats
echo '===================================================================================='
echo
echo '       ___           ___                       ___           ___           ___     '
echo '      /\  \         /\  \          ___        /\__\         /\  \         /\  \    '
echo '     /::\  \        \:\  \        /\  \      /:/  /        /::\  \       /::\  \   '
echo '    /:/\:\  \        \:\  \       \:\  \    /:/__/        /:/\:\  \     /:/\:\  \  '
echo '   /:/  \:\  \       /::\  \      /::\__\  /::\__\____   /::\~\:\  \   /:/  \:\__\ '
echo '  /:/__/ \:\__\     /:/\:\__\  __/:/\/__/ /:/\:::::\__\ /:/\:\ \:\__\ /:/__/ \:|__|'
echo '  \:\  \ /:/  /    /:/  \/__/ /\/:/  /    \/_|:|~~|~    \/_|::\/:/  / \:\  \ /:/  /'
echo '   \:\  /:/  /    /:/  /      \::/__/        |:|  |        |:|::/  /   \:\  /:/  / '
echo '    \:\/:/  /     \/__/        \:\__\        |:|  |        |:|\/__/     \:\/:/  /  '
echo '     \::/  /                    \/__/        |:|  |        |:|  |        \::/__/   '
echo '      \/__/                                   \|__|         \|__|         ~~       '
echo
echo 

ip=$(ip addr|grep 'inet '|grep global|head -n1|awk '{print $2}'|cut -f1 -d/)

echo "System Information"
echo "Web Access = http://$ip/otikrd"
echo "User : sysadmin Password : sysadmin"
