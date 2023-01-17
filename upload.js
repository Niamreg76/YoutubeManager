function submitForm() {
    const input = document.getElementById('file-input');
    input.addEventListener('drop', (event) => {
      const file = event.target.files[0];
      const filePath = file.mozFullPath;
      console.log(thisvalue.form.file.value.toString());
    });
    console.log("test")
  }
  