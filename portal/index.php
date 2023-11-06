<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ลงทะเบียนใช้งานอินเตอร์เน็ต</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .registration-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 25px 58px 20px 36px;
        width: 343px;
    }

    .registration-container h1 {
        text-align: center;
        margin-bottom: 41px;
        text-align: center;
        font-size: 25px;


    }

    .registration-form label {
        display: block;
        margin-bottom: 8px;
    }

    .registration-form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .registration-form button {
        background-color: #007bff;
        color: #fff;
        padding: 16px 37px 17px 19px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 365px;
        font-size: 20px;
    }

    .registration-form button:hover {
        background-color: #0056b3;
    }
    .msg-error{
      color: red;
      font-size: 20px;
      padding: 24px;
      text-align: center;
      border-radius: 10px;
      border: 1px solid #d4c2c2;
      width: 91%;
      margin-bottom: 27px;
      background-color: antiquewhite;
    }
    .msg-success{
      color: green;
      font-size: 20px;
      padding: 24px;
      text-align: center;
      border-radius: 10px;
      border: 1px solid #c5c6c4;
      width: 91%;
      margin-bottom: 27px;
      background-color: aliceblue;
    }
    .footer {
        align-items: center;
        display: flex;
        height: 40px;        
    }
    .footer .center {
        margin:0 auto;
    }
    .footer a {
        text-decoration:none;
        color:green;
        font-size:14px;
    }

  </style>
</head>
<body>
  <div class="registration-container">
    
    <h1>ลงทะเบียนใช้งาน | Sign Up</h1>

    <div id="response" style="display:none;" class="msg-success"></div>
    
    <form class="registration-form" id="frmRegister" action="save.php" method="POST">
      <label for="FirstName">ชื่อจริง:</label>
      <input type="text" class="frm" id="FirstName" name="FirstName" placeholder="กรอกชื่อไม่เกิน 50 ตัวอักษร" oninvalid="this.setCustomValidity('กรุณากรอกชื่อของท่าน ไม่เกิน 50 ตัวอักษร')"  oninput="setCustomValidity('')" required>

      <label for="LastName">นามสกุล:</label>
      <input type="text" class="frm" id="LastName" name="LastName" placeholder="กรอกชื่อไม่เกิน 50 ตัวอักษร" oninvalid="this.setCustomValidity('กรุณากรอกนามสกุลของท่าน ไม่เกิน 50 ตัวอักษร')"  oninput="setCustomValidity('')" required>

      <label for="CardID">เลขที่บัตรประจำตัวประชาชน 13 หลัก:</label>
      <input type="text" class="frm" id="CardID" name="CardID" placeholder="เลขบัตรประชาชน 13 หลักของท่าน" oninvalid="this.setCustomValidity('กรุณากรอกรหัสบัตรประจำตัวประชาชน 13 หลัก')"  oninput="setCustomValidity('')" required>
      
      <label for="email">อีเมล์ | Email:</label>
      <input type="email" class="frm" id="Email" name="Email" placeholder="กรอกอีเมลให้ครบถ้วน" oninvalid="this.setCustomValidity('กรุณากรอกอีเมลของท่าน')"  oninput="setCustomValidity('')" required>
      
      <label for="Mobile">เบอร์มือถือ (เพื่อรับ SMS):</label>
      <input type="text" class="frm" id="Mobile" name="Mobile" oninvalid="this.setCustomValidity('กรุณากรอกเบอร์มือถือของคุณ')"  oninput="setCustomValidity('')" required>
      
      <button type="submit" id="submit">ลงทะเบียน</button>
    </form>

    
    <div class="footer">
      <label class="center"><a href="#">หน้าหลัก</a> | <a href="changepass.php">เปลี่ยนรหัสผ่าน</a></label>
      <br><br>
      <!--
      <label class="center" style="text-align:center;font-size:10px;color:gray;">พัฒนาโดย <a href="https://www.otiknetwork.com">บริษัท โอติกเน็ตเวิร์ค จำกัด</a> | 02-538-4378</label>
      -->
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

  <script>
    $(document).ready(function () {
      $("form").submit(function (event) {
      var formData = {
        FirstName: $("#FirstName").val(),
        LastName: $("#LastName").val(),
        CardID: $("#CardID").val(),
        Email: $("#Email").val(),
        Mobile: $("#Mobile").val(),
      };

      $.ajax({
        type: "POST",
        url: "save.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        const obj = JSON.parse(data);
        if(obj.message == 'Successfully'){    
          $('#response').css('display','block');
          $('#response').removeClass('msg-error').addClass('msg-success');
          $('.frm').prop('readonly', true);
          $('#submit').prop('disabled', true);
          $("#response").html('ลงทะเบียนเรียบร้อย');
        }else{
          $('#response').css('display','block');
          $('#response').removeClass('msg-success').addClass('msg-error');
          $("#response").html('พบข้อผิดพลา : ' + obj.data);
        }        
        console.log(data);
      });
        event.preventDefault();
      });
    });
  </script>
</body>
</html>
