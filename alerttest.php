
<head>
  <!-- ... ส่วนอื่น ๆ ... -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <!-- ... ส่วนอื่น ๆ ... -->

  <script>
    function showSweetAlert() {
      Swal.fire({
        title: 'สวัสดี!',
        text: 'นี่คือตัวอย่าง SweetAlert',
        icon: 'error',
        confirmButtonText: 'ตกลง'
      });
    }
  </script>

  <button onclick="showSweetAlert()" >แสดง SweetAlert</button>

</body>
