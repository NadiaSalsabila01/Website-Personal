function validateForm() {
    const name = document.getElementById("name").value.trim();
    const comment = document.getElementById("comment").value.trim();

    if (name === "" || comment === "") {
        alert("Nama dan komentar wajib diisi.");
        return false;
    }
    return true;
}
