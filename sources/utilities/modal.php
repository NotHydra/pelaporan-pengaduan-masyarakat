<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmModal(type, value, hidden = null) {
        if (hidden != null) {
            document.getElementById(hidden).style.display = "none";
        };

        Swal.fire({
            title: "Apakah anda yakin?",
            icon: "question",
            iconColor: localStorage.colorThemeType == "light" ? "#545454" : "#ffffff",
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak",
            confirmButtonColor: "#48c774",
            cancelButtonColor: "#F14668"
        }).then((result) => {
            if (result.isConfirmed) {
                if (type == "location") {
                    window.location = value;
                } else if (type == "form") {
                    value.submit();
                } else if (type == "action") {
                    value();
                };
            };

            if (hidden != null) {
                setTimeout(() => {
                    document.getElementById(hidden).style.display = "block";
                }, 250);
            };
        });

        return false;
    };

    function errorModal(text, path, hidden = null) {
        if (hidden != null) {
            document.getElementById(hidden).style.display = "none";
        };

        Swal.fire({
            title: "Gagal",
            text: text,
            icon: "error",
            width: "525px",
            focusConfirm: false,
            showConfirmButton: false,
            showCloseButton: true
        }).then((result) => {
            if (path != null) {
                window.location = path;
            };

            if (hidden != null) {
                setTimeout(() => {
                    document.getElementById(hidden).style.display = "block";
                }, 250);
            };
        });
    };

    function successModal(text, path, hidden = null) {
        if (hidden != null) {
            document.getElementById(hidden).style.display = "none";
        };

        Swal.fire({
            title: "Berhasil",
            text: text,
            icon: "success",
            width: "525px",
            focusConfirm: false,
            showConfirmButton: false,
            showCloseButton: true
        }).then((result) => {
            if (path != null) {
                window.location = path;
            };

            if (hidden != null) {
                setTimeout(() => {
                    document.getElementById(hidden).style.display = "block";
                }, 250);
            };
        });
    };
</script>