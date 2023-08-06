OTIKRD (Radius External)
-----------------------------------
พัฒนาโดย อำนวย ปิ่นทอง / บริษัท โอติกเน็ตเวิร์ค จำกัด

******************************************
ความต้องการของระบบ / Requirement
******************************************
OS : Ubuntu 20.04 server และต้องใช้สิทธิ์เป็น root
CPU : 1.4 GHz 64-bit CPU minimum
RAM : ขั้นต่ำ 512 MB
Storage : ขั้นต่ำ 50Gb

******************************************
ฟีเจอร์ที่รองรับ / Features
******************************************
- สามารถกำหนดแพ็คเกตเองได้ Profile)
- สามารถสร้าง Account ได้แบบ One / Batch
- สามารถตรวจสอบผู้ใช้ที่ออนไลน์อยู่ ณ ปัจจุบันได้ (User Online)
- สามารถนำเข้าผู้ใช้จาก csv ไฟล์ได้ (กรณีนำไปใช้กับโรงเรียน นำเข้ารายชื่อนักเรียน พร้อมรหัสผ่าน เป็นต้น)



การติดตั้ง
root@otikrad:/# cd /tmp
root@otikrad:/tmp# git clone https://github.com/npintong/otikrd.git
root@otikrad:/tmp# cd otikrd/
root@otikrad:/tmp/otikrd# chmod 777 setup.sh 
root@otikrad:/tmp/otikrd# ./setup.sh 


สำหรับการเชื่อมต่อกับ MikroTik ให้ใช้ คีย์ Secret key = Otik@Secret

คลิปสอนการติดตั้งและใช้งานดูได้ที่
https://youtu.be/1cM31V_QtYs