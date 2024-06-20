function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('profile-picture-preview');
        output.style.backgroundImage = `url(${reader.result})`;
    };
    reader.readAsDataURL(event.target.files[0]);
}