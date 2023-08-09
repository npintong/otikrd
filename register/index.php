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
  </style>
</head>
<body>
  <div class="registration-container">
    
    <h1>ลงทะเบียนใช้งาน | Sign Up</h1>

    <div id="response" style="color:green;font-size:20px;padding:10px;text-align:center;"></div>
    
    <form class="registration-form" id="frmRegister" action="save.php" method="POST">
      <label for="FirstName">ชื่อจริง:</label>
      <input type="text" id="FirstName" name="FirstName" placeholder="กรอกชื่อไม่เกิน 50 ตัวอักษร" required>

      <label for="LastName">นามสกุล:</label>
      <input type="text" id="LastName" name="LastName" placeholder="กรอกชื่อไม่เกิน 50 ตัวอักษร" required>

      <label for="CardID">เลขที่บัตรประจำตัวประชาชน 13 หลัก:</label>
      <input type="text" id="CardID" name="CardID" placeholder="เลขบัตรประชาชน 13 หลักของท่าน"required>
      
      <label for="email">อีเมล์ | Email:</label>
      <input type="email" id="Email" name="Email" placeholder="กรอกอีเมลให้ครบถ้วน" required>
      
      <label for="Mobile">เบอร์มือถือ (เพื่อรับ SMS):</label>
      <input type="text" id="Mobile" name="Mobile" required>
      
      <button type="submit">ลงทะเบียน</button>
    </form>
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
          $("#response").html('ลงทะเบียนเรียบร้อย');
        }else{
          $("#response").html('พบข้อผิดพลาดในการลงทะเบียน ลองใหม่อีกครั้ง');
        }        
        console.log(data);
      });
        event.preventDefault();
      });
    });
  </script>
</body>
</html>
