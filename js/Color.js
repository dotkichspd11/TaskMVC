    var color = document.getElementById("TrangThai");
    var elements = document.getElementsByClassName("card-status-ready");
    for (var i = 0; i < elements.length; i++) {
        var value = elements[i].getAttribute('value');
        switch (value) {
            case "Sẵn Sàng":
                {
                    elements[i].style.color = "green";
                    break;
                }
            case "Đang Được Thuê":
                {
                    elements[i].style.color = "yellow";
                    break;
                }
            case "Tới Hạn Trả":
                {
                    elements[i].style.color = "red";
                    break;
                }
            default:
                console.log("Trang Thái lỗi");
        }
    }

    function ColorFunction() {
        color.style.color = color.options[color.selectedIndex].style.color;
    }