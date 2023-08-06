#!/bin/sh

set -e

if [ "$(id -u)" != "0" ]; then
	echo "You must be root to execute the script. Exiting."
	exit 1
fi


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

sudo systemctl enable --now apache2

echo 
echo "==========================================================="
echo "Install Mariadb Server"
echo "==========================================================="
echo 

echo "installing..."
sudo apt install -y mariadb-server
sleep 1

echo "(Startup) Mariadb Server"
sudo systemctl enable mysql
sleep 1

echo "(Start) Mariadb Server"
sudo systemctl start mysql
sleep 1

mysql -u root < script.sql

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
sudo ln -s /etc/freeradius/3.0/mods-available/sql /etc/freeradius/3.0/mods-enabled/
sleep 1
sudo chgrp -h freerad /etc/freeradius/3.0/mods-available/sql
sleep 1
sudo chown -R freerad:freerad /etc/freeradius/3.0/mods-enabled/sql
sleep 1

echo "Enable SqlCounter"
sudo ln -s /etc/freeradius/3.0/mods-available/sqlcounter /etc/freeradius/3.0/mods-enabled/
sleep 1
sudo chgrp -h freerad /etc/freeradius/3.0/mods-available/sqlcounter
sleep 1
sudo chown -R freerad:freerad /etc/freeradius/3.0/mods-enabled/sqlcounter
sleep 1

echo 
echo "====================================="
echo "Allow run Asterisk user & group"
echo "====================================="
echo 

cd /tmp/otikrd
mv otikrd /var/www/html/



sed -i 's/dialect = "sqlite"/dialect = "mysql"/' /etc/freeradius/3.0/mods-enabled/sql
driver = "rlm_sql_null"
sed -i 's/driver = "rlm_sql_null"/#driver = "rlm_sql_null"/' /etc/freeradius/3.0/mods-enabled/sql
sed -i 's/#AST_GROUP="asterisk"/AST_GROUP="asterisk"/' /etc/default/asterisk

sleep 3

sed -i 's/;runuser = asterisk/runuser = asterisk/' /etc/asterisk/asterisk.conf
sed -i 's/;rungroup = asterisk/rungroup = asterisk/' /etc/asterisk/asterisk.conf

sleep 3
sed -i 's/autoload = no/autoload = yes/' /etc/asterisk/modules.conf


sleep 2

echo 
echo "====================================="
echo "Prepare Default configuration"
echo "====================================="
echo 


echo "" > /etc/asterisk/pjsip.conf

sleep 1

echo "Create sip files"

touch /etc/asterisk/pjsip_acl.conf
touch /etc/asterisk/pjsip_aor.conf
touch /etc/asterisk/pjsip_astpub.conf
touch /etc/asterisk/pjsip_auth.conf
touch /etc/asterisk/pjsip_endpoint.conf
touch /etc/asterisk/pjsip_identify.conf
touch /etc/asterisk/pjsip_inpub.conf
touch /etc/asterisk/pjsip_notify.conf
touch /etc/asterisk/pjsip_outpub.conf
touch /etc/asterisk/pjsip_outreg.conf
touch /etc/asterisk/pjsip_phoneprov.conf
touch /etc/asterisk/pjsip_wizard.conf



echo "Change owner files"

chown -R asterisk:asterisk /etc/asterisk/pjsip_acl.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_aor.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_astpub.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_auth.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_endpoint.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_identify.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_inpub.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_notify.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_outpub.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_outreg.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_phoneprov.conf
chown -R asterisk:asterisk /etc/asterisk/pjsip_wizard.conf

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


echo 
echo "====================================="
echo "Move old file"
echo "====================================="
echo 

mkdir /etc/asterisk/old_file
mv /etc/asterisk/*.old /etc/asterisk/old_file


sleep 1
echo 
echo "====================================="
echo "Create CDR File"
echo "====================================="
echo 

cat > /etc/asterisk/cdr.conf << EOF
[general]
enable=yes

[radius]
usegmtime=yes ; log date/time in GMT
loguniqueid=yes ; log uniqueid
loguserfield=yes ; log user field
radiuscfg => /etc/radcli/radiusclient.conf


[custom]
; We log the unique ID as it can be useful for troubleshooting any issues
; that arise.
loguniqueid=yes
EOF

sleep 1

echo 
echo "====================================="
echo "Create startup and restart asterisk"
echo "====================================="
echo 

sudo systemctl restart asterisk
sleep 3
sudo systemctl enable asterisk
sleep 3

echo 
echo "====================================="
echo "Allow firewall 5060 and 5061"
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

  _____  ______   __ _______     _______ _______ ______ __  __
 |  __ \|  _ \ \ / // ____\ \   / / ____|__   __|  ____|  \/  |
 | |__) | |_) \ V /| (___  \ \_/ / (___    | |  | |__  | \  / |
 |  ___/|  _ < > <  \___ \  \   / \___ \   | |  |  __| | |\/| |
 | |    | |_) / . \ ____) |  | |  ____) |  | |  | |____| |  | |
 |_|    |____/_/ \_\_____/   |_| |_____/   |_|  |______|_|  |_|


Welcome to pbxsystem | By OtikNetwork
www.otiknetwork.com / 02-538-4378, 095-549-9819



EOF



# Congrats
echo '==================================================================='
echo
echo ' _____  ______   __ _______     _______ _______ ______ __  __     '
echo ' |  __ \|  _ \ \ / // ____\ \   / / ____|__   __|  ____|  \/  |   '
echo ' | |__) | |_) \ V /| (___  \ \_/ / (___    | |  | |__  | \  / |   '
echo ' |  ___/|  _ < > <  \___ \  \   / \___ \   | |  |  __| | |\/| |   '
echo ' | |    | |_) / . \ ____) |  | |  ____) |  | |  | |____| |  | |   '
echo ' |_|    |____/_/ \_\_____/   |_| |_____/   |_|  |______|_|  |_|   '
echo    
echo

ip=$(ip addr|grep 'inet '|grep global|head -n1|awk '{print $2}'|cut -f1 -d/)

echo "Your ip address = $ip"
