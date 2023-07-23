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
echo "Install Build Dependencies"
echo "==========================================================="
echo 
sudo apt update
sudo apt install -y apache2
sudo apt install -y php php-gd php-mysqli php-pdo

echo 
echo "==========================================================="
echo "Download Asterisk 18 tarball"
echo "==========================================================="
echo 

sudo apt policy asterisk
cd ~
wget http://downloads.asterisk.org/pub/telephony/asterisk/asterisk-18-current.tar.gz

tar xvf asterisk-18-current.tar.gz

cd asterisk-18*/
contrib/scripts/get_mp3_source.sh

echo 
echo "==========================================================="
echo "Build and Install Asterisk 18 on Ubuntu 20.04"
echo "==========================================================="
echo 

./configure

make menuselect.makeopts

menuselect/menuselect \
--enable chan_mobile \
--enable chan_ooh323 \
--enable format_mp3 \
--enable res_config_mysql \
--enable app_macro \
--enable CORE-SOUNDS-EN-WAV \
--enable CORE-SOUNDS-EN-ULAW \
--enable CORE-SOUNDS-EN-ALAW \
--enable CORE-SOUNDS-EN-GSM \
--enable CORE-SOUNDS-EN-G729 \
--enable CORE-SOUNDS-EN-G722 \
--enable CORE-SOUNDS-EN-SLN16 \
--enable CORE-SOUNDS-EN-SIREN7 \
--enable CORE-SOUNDS-EN-SIREN14 \
--enable MOH-OPSOUND-WAV \
--enable MOH-OPSOUND-ULAW \
--enable MOH-OPSOUND-ALAW \
--enable MOH-OPSOUND-GSM \
--enable MOH-OPSOUND-G729 \
--enable MOH-OPSOUND-G722 \
--enable MOH-OPSOUND-SLN16 \
--enable MOH-OPSOUND-SIREN7 \
--enable MOH-OPSOUND-SIREN14 \
--enable EXTRA-SOUNDS-EN-WAV \
--enable EXTRA-SOUNDS-EN-ULAW \
--enable EXTRA-SOUNDS-EN-ALAW \
--enable EXTRA-SOUNDS-EN-GSM \
--enable EXTRA-SOUNDS-EN-G729 \
--enable EXTRA-SOUNDS-EN-G722 \
--enable EXTRA-SOUNDS-EN-SLN16 \
--enable EXTRA-SOUNDS-EN-SIREN7 \
--enable EXTRA-SOUNDS-EN-SIREN14 \
 menuselect.makeopts
#make menuselect
sudo make
sudo make install
#sudo make progdocs
sudo make samples
sudo make config
sudo ldconfig
sudo make basic-pbx

echo 
echo "====================================="
echo "Create asterisk user and group"
echo "====================================="
echo 

sudo groupadd asterisk
sleep 1
sudo useradd -r -d /var/lib/asterisk -g asterisk asterisk
sleep 1
sudo usermod -aG audio,dialout asterisk
sleep 1
sudo chown -R asterisk.asterisk /etc/asterisk
sleep 3

sudo chown -R asterisk.asterisk /var/lib/asterisk
sudo chown -R asterisk.asterisk /var/log/asterisk
sudo chown -R asterisk.asterisk /var/spool/asterisk

sleep 3

sudo chown -R asterisk.asterisk /usr/lib/asterisk
sleep 3

sudo chmod -R 750 /var/lib/asterisk /usr/lib/asterisk /etc/asterisk
sudo chmod -R 750 /var/log/asterisk /usr/lib/asterisk /etc/asterisk
sudo chmod -R 750 /var/run/asterisk /usr/lib/asterisk /etc/asterisk
sudo chmod -R 750 /var/spool/asterisk /usr/lib/asterisk /etc/asterisk

echo 
echo "====================================="
echo "Allow run Asterisk user & group"
echo "====================================="
echo 

sed -i 's/#AST_USER="asterisk"/AST_USER="asterisk"/' /etc/default/asterisk
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


echo "Change mode file to 750"

chmod 750 /etc/asterisk/pjsip_acl.conf
chmod 750 /etc/asterisk/pjsip_aor.conf
chmod 750 /etc/asterisk/pjsip_astpub.conf
chmod 750 /etc/asterisk/pjsip_auth.conf
chmod 750 /etc/asterisk/pjsip_endpoint.conf
chmod 750 /etc/asterisk/pjsip_identify.conf
chmod 750 /etc/asterisk/pjsip_inpub.conf
chmod 750 /etc/asterisk/pjsip_notify.conf
chmod 750 /etc/asterisk/pjsip_outpub.conf
chmod 750 /etc/asterisk/pjsip_outreg.conf
chmod 750 /etc/asterisk/pjsip_phoneprov.conf
chmod 750 /etc/asterisk/pjsip_wizard.conf

sleep 1

cat > /etc/asterisk/pjsip.conf << EOF
;       Do NOT edit this file as it is auto-generated by IPPBX         ;
;----------------------------------------------------------------------;
[global]
type=global
user_agent=IPPBX Software Edition

[transport-udp]
type=transport
protocol=udp
bind=0.0.0.0:5060
tos=96
cos=3

[endpoint-basic](!)
rtp_keepalive = 1


#include  pjsip_acl.conf
#include  pjsip_aor.conf
#include  pjsip_astpub.conf
#include  pjsip_auth.conf
#include  pjsip_endpoint.conf
#include  pjsip_identify.conf
#include  pjsip_inpub.conf
#include  pjsip_notify.conf
#include  pjsip_outpub.conf
#include  pjsip_outreg.conf
#include  pjsip_phoneprov.conf
#include  pjsip_wizard.conf
EOF

sleep 1

cat > /etc/asterisk/pjsip_endpoint.conf << EOF
;--------------------------------------------------------------------------------;
;          Do NOT edit this file as it is auto-generated by IPPBX.               ;
;--------------------------------------------------------------------------------;

[100][endpoint-basic]
type=endpoint
context=DLPN_Dialplan100
disallow=all
allow=ulaw
allow=alaw
transport=transport-udp
auth=100
aors=100
callerid=Amnuay Pintong <100>
mailboxes=100@default
named_call_group=A
named_pickup_group=A

[101][endpoint-basic]
type=endpoint
context=DLPN_Dialplan101
disallow=all
allow=ulaw
allow=alaw
transport=transport-udp
auth=101
aors=101
callerid=101 <101>
mailboxes=101@default
named_call_group=A
named_pickup_group=A

[102]
type=endpoint
context=DLPN_Dialplan102
disallow=all
allow=ulaw
allow=alaw
transport=transport-udp
auth=102
aors=102
callerid=102 <102>
mailboxes=102@default
named_call_group=A
named_pickup_group=A
EOF

sleep 1

cat > /etc/asterisk/pjsip_auth.conf << EOF
;--------------------------------------------------------------------------------;
;          Do NOT edit this file as it is auto-generated by IPPBX.               ;
;--------------------------------------------------------------------------------;

[100]
type=auth
auth_type=userpass
username=100
password=SF4F3jwqWP

[101]
type=auth
auth_type=userpass
username=101
password=mZEwpWSKI8

[102]
type=auth
auth_type=userpass
username=102
password=wblVlKk3RE

EOF

sleep 1

cat > /etc/asterisk/pjsip_aor.conf << EOF
;--------------------------------------------------------------------------------;
;          Do NOT edit this file as it is auto-generated by IPPBX.               ;
;--------------------------------------------------------------------------------;

[100]
type=aor
max_contacts=1

[101]
type=aor
max_contacts=1

[102]
type=aor
max_contacts=1

EOF

sleep 1

cat > /etc/asterisk/extensions.conf << EOF
[general]
static=yes
writeprotect=no
clearglobalvars=no

[Local_Policy_CallingRules]
include = sip_exten_dial_config

[stdexten]
exten = s,1,Gosub(sysdial,s,1(\${ARG1}))

[sysdial]
exten = s,1,Dial(PJSIP/\${ARG1})
exten = s,2,Hangup()

[sip_exten_dial_config]
exten = 100,1,Gosub(stdexten,s,1(\${EXTEN}))
exten = 101,1,Gosub(stdexten,s,1(\${EXTEN}))

[DLPN_Dialplan100]
include = Local_Policy_CallingRules

[DLPN_Dialplan101]
include = Local_Policy_CallingRules

[DLPN_Dialplan102]
include = Local_Policy_CallingRules
EOF

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

sudo ufw allow proto tcp from any to any port 5060,5061
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
