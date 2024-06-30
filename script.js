function seeMore(id) {

    var seemore = document.getElementById("seemore" + id);
    var showless = document.getElementById("showless" + id);
    var pro1 = document.getElementById(id);

    pro1.classList.toggle("d-none");
    seemore.classList.toggle("d-none");
    showless.classList.toggle("d-none");

}
var val = 0;

function star(x, y) {

    if (x == "1") {
        if (document.getElementById("star1" + y).classList = "bi bi-star fs-1") {

            document.getElementById("star1" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star2" + y).classList = "bi bi-star fs-1";
            document.getElementById("star3" + y).classList = "bi bi-star fs-1";
            document.getElementById("star4" + y).classList = "bi bi-star fs-1";
            document.getElementById("star5" + y).classList = "bi bi-star fs-1";
            val = 1;


        }
    }
    if (x == "2") {
        if (document.getElementById("star2" + y).classList = "bi bi-star fs-1") {
            document.getElementById("star1" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star2" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star3" + y).classList = "bi bi-star fs-1";
            document.getElementById("star4" + y).classList = "bi bi-star fs-1";
            document.getElementById("star5" + y).classList = "bi bi-star fs-1";
            val = 2;
        }
    }

    if (x == "3") {
        if (document.getElementById("star3" + y).classList = "bi bi-star fs-1") {
            document.getElementById("star1" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star2" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star3" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star4" + y).classList = "bi bi-star fs-1";
            document.getElementById("star5" + y).classList = "bi bi-star fs-1";
            val = 3;
        }
    }
    if (x == "4") {
        if (document.getElementById("star4" + y).classList = "bi bi-star fs-1") {
            document.getElementById("star1" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star2" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star3" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star4" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star5" + y).classList = "bi bi-star fs-1";
            val = 4;

        }
    }
    if (x == "5") {
        if (document.getElementById("star5" + y).classList = "bi bi-star fs-1") {
            document.getElementById("star1" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star2" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star3" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star4" + y).classList = "bi bi-star-fill text-warning fs-1";
            document.getElementById("star5" + y).classList = "bi bi-star-fill text-warning fs-1";
            val = 5;
        }
    }
}
var mod;

function feedback(id) {

    var feed = document.getElementById("feedbackModal" + id);

    mod = new bootstrap.Modal(feed);
    mod.show();

}

function feedback1(id, id1) {

    var pid = id;
    var rate = val;
    var com = document.getElementById("comment").value;
    alert(com);
    var f = new FormData();
    f.append("val", rate);
    f.append("comment", com);
    f.append("id", pid);
    f.append("id1", id1);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                document.getElementById("but" + pid).classList = "col-12 col-lg-6 btn btn-primary m-1 d-none";
                // window.location.reload();
                mod.hide();
            }
        }
    }
    r.open("POST", "feedbackProcess.php", true);
    r.send(f);
}

function feedback3(id) {

    var feed = document.getElementById("feedbackModale" + id);

    mod = new bootstrap.Modal(feed);
    mod.show();

}

function feedback2(id, id1) {

    var pid = id;
    var rate = val;
    var com = document.getElementById("comment2").value;

    var f = new FormData();
    f.append("val", rate);
    f.append("comment2", com);
    f.append("id", pid);
    f.append("id1", id1);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                document.getElementById("but1" + pid).classList = "col-12 col-lg-6 btn btn-primary m-1 d-none";
                // window.location.reload();
                mod.hide();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "feedbackProcess1.php", true);
    r.send(f);
}


function view(id) {
    var product = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            window.location = "productView.php";
        }
    }
    r.open("GET", "viewProcess.php?id=" + product, true);
    r.send();
}

function view1(id) {
    var qty = document.getElementById("q" + id).value;
    var product = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            window.location = "productView.php?qty=" + qty;
        }
    }
    r.open("GET", "viewProcess.php?id=" + product, true);
    r.send();
}

function changeProfilePic() {
    var view = document.getElementById("viewImg"); //img tag
    var file = document.getElementById("profileimg"); //file chooser

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
        alert("Profile Image Successfully Uploaded. Please press Update my profile Button to Save the picture");
    }
}

function addProductImg() {
    var view = document.getElementById("viewImg"); //img tag
    var file = document.getElementById("productPic"); //file chooser
    var txt = document.getElementById("displayText");

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        txt.classList = "d-none";
        view.classList = "d-block";
        view.src = url;
    }
}

function updateProfile() {

    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");
    var f = new FormData();

    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);


    if (image.files.length == 0) {

        alert("You have not selected a profile image");
    } else {
        f.append("image", image.files[0]);

    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            alert(t);

        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);




}

function cart(id1) {

    var product = id1;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("s" + id1).classList = "btn btn-secondary mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-6";
            document.getElementById("s" + id1).innerHTML = "Added to Cart";
            document.getElementById("s" + id1).disabled = "true";

        }
    }
    r.open("GET", "cartProcess.php?id1=" + product, true);
    r.send();
}

function watchlist(id1) {

    var product = id1;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("w" + id1).classList = "btn btn-danger mt-2 mt-lg-3 ms-lg-1 col-12 col-lg-11";
            document.getElementById("w" + id1).innerHTML = "Added to Watchlist";
            document.getElementById("w" + id1).disabled = "true";

        }
    }
    r.open("GET", "watchlistProcess.php?id1=" + product, true);
    r.send();
}

function cart1(id1) {

    var product = id1;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("g" + id1).classList = "btn btn-secondary col-9";
            document.getElementById("g" + id1).innerHTML = "Added to Cart";
            document.getElementById("g" + id1).disabled = "true";

        }
    }
    r.open("GET", "cartProcess.php?id1=" + product, true);
    r.send();
}

function watchlist1(id1) {

    var product = id1;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("m" + id1).classList = "btn btn-danger col-9";
            document.getElementById("m" + id1).innerHTML = "Added to Watchlist";
            document.getElementById("m" + id1).disabled = "true";

        }
    }
    r.open("GET", "watchlistProcess.php?id1=" + product, true);
    r.send();
}

function remove(id2) {
    var product = id2;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                window.location.reload();
            }

        }
    }
    r.open("GET", "cartRemoveProcess.php?id2=" + product, true);
    r.send();
}

function removeWatch2(id2) {
    var product = id2;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                window.location.reload();
            }

        }
    }
    r.open("GET", "watchRemoveProcess1.php?id2=" + product, true);
    r.send();
}

function removeWatch(id2) {
    var product = id2;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                window.location.reload();
            }

        }
    }
    r.open("GET", "watchRemoveProcess.php?id2=" + product, true);
    r.send();
}

function summary(id3) {

    var product = id3;

    var qty = document.getElementById("q" + id3).value;

    var f = new FormData();
    f.append("id3", product);
    f.append("q", qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("items").innerHTML = t;
            window.location.reload();
        }
    }
    r.open("POST", "summary.php", true);
    r.send(f);

}

function removeAll() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location.reload();
            }

        }
    }
    r.open("GET", "removeProcess.php", true);
    r.send();


}

function searchb() {
    var search = document.getElementById("bsearch").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;


            document.getElementById("div").classList = "col-12 p-3 m-0";
            document.getElementById("div").style.height = "auto";
            document.getElementById("div").style.backgroundColor = "rgb(181,230,29)";
            document.getElementById("box").innerHTML = t;
        }
    }
    r.open("GET", "search.php?s=" + search, true);
    r.send();

}

function changePage() {
    var signUpBox = document.getElementById("signup");
    var signInBox = document.getElementById("signin");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}


function signUp() {
    var f1 = document.getElementById("f1").value;
    var l = document.getElementById("l").value;
    var m = document.getElementById("m").value;
    var e = document.getElementById("e").value;
    var p = document.getElementById("p").value;
    var g = document.getElementById("g").value;

    var f = new FormData();
    f.append("f1", f1);
    f.append("l", l);
    f.append("m", m);
    f.append("e", e);
    f.append("g", g);
    f.append("p", p);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            const toastTrigger = document.getElementById('liveToastBtn')
            const toastLiveExample = document.getElementById('liveToast')
            if (toastTrigger) {
                toastTrigger.addEventListener('click', () => {
                    const toast = new bootstrap.Toast(toastLiveExample)

                    toast.show()

                })
                document.getElementById("msg").innerHTML = t;
            }

            if (t == "Success") {
                changePage();
            }
        }



    }
    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}

function signIn() {

    var e1 = document.getElementById("e1").value;
    var p1 = document.getElementById("p1").value;
    var c1 = document.getElementById("c1").value;
    var check;
    if (c1 == "on") {
        check = 1;
    } else {
        check = 2;
    }

    var f = new FormData();
    f.append("e1", e1);
    f.append("p1", p1);
    f.append("c1", check);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            const toastTrigger = document.getElementById('liveToastBtn2')
            const toastLiveExample = document.getElementById('liveToast2')
            if (toastTrigger) {
                toastTrigger.addEventListener('click', () => {
                    const toast = new bootstrap.Toast(toastLiveExample)

                    toast.show()

                })
                document.getElementById("msg2").innerHTML = t;
            }

            if (t == "Success") {
                window.location = "home.php";
            }
        }



    }
    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

function adSearch() {

    var text = document.getElementById("searcha").value;
    var price = document.getElementById("price").value;
    var qty = document.getElementById("qty").value;
    var p1 = document.getElementById("p1").value;
    var p2 = document.getElementById("p2").value;

    var selection = document.getElementById("select").value;

    var f = new FormData();
    f.append("searcha", text);
    f.append("select", selection);
    f.append("price", price);
    f.append("qty", qty);
    f.append("p1", p1);
    f.append("p2", p2);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("searchrs").innerHTML = t;

        }
    }
    r.open("POST", "advanceSearchProcess.php", true);
    r.send(f);
}

function changeButton() {
    var b1 = document.getElementById("b1");
    var b2 = document.getElementById("b2");
    var b3 = document.getElementById("b3");
    b1.className = "btn btn-outline-success d-none";
    b2.className = "btn btn-outline-success border-0 d-block offset-4";
    b3.className = "col-3  col-lg-2 mt-2 offset-lg-4";
}

function printPg() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}


function reveal() {
    var tog = document.getElementById("tog");
    if (tog.classList == "bi bi-eye") {
        tog.classList = "bi bi-eye-slash ";
        document.getElementById("password").type = "text";
    } else {
        tog.classList = "bi bi-eye";
        document.getElementById("password").type = "password";
    }
}

function forgotPassword() {

    var e = document.getElementById("e1").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

        }
    }
    r.open("GET", "forgotPasswordProcess.php?e=" + e, true);
    r.send();
}

function savePg() {
    window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    doc.document = window.bdy;
    doc.save('document.pdf');
    document.body.innerHTML = body;
}

function qtycon(x) {
    var value1 = document.getElementById("qty").value
    if (value1 >= x) {
        alert("Maximum Quantity is" + x);
        value1.value = x;
    }
    if (value1 <= "1") {
        alert("Minimum Quantity is 1");
        value1.value = "1";
    }
}

// 

function payNow(id) {

    var qty = document.getElementById("qty").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            var obj = JSON.parse(t);
            var mail = obj["mail"];
            var amount = obj["amount"];
            if (t == "1") {
                alert("Please Login or Sign Up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your Profile First");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    saveInvoice(orderId, id, mail, amount, qty);
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };
                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221108", // Replace your Merchant ID
                    "return_url": "http://localhost/soopervegan/productView.php?id" + id, // Important
                    "cancel_url": "http://localhost/soopervegan/productView.php?id" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                payhere.startPayment(payment);


            };
        }





    }


    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}


function saveInvoice(orderId, id, mail, amount, qty) {
    alert("ok2");
    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}



function select(id) {

    var customer_id = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("d" + customer_id).style.backgroundColor = "lightgreen";
            document.getElementById("whole").innerHTML = t;

        }
    }
    r.open("GET", "chatProcess.php?id=" + customer_id, true);
    r.send();
}

function send(id) {
    var msg = document.getElementById("text").value;
    var customer = id;
    var f = new FormData();
    f.append("text", msg);
    f.append("id", customer);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("box").innerHTML = t;
        }


    }

    r.open("POST", "chatProcess1.php", true);
    r.send(f);
}

function send1() {
    var msg1 = document.getElementById("msg1").value;
    alert(msg1);
    var customer = document.getElementById("to").value;
    var f = new FormData();
    f.append("msg1", msg1);
    f.append("to", customer);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;


        }


    }

    r.open("POST", "chatProcess2.php", true);
    r.send(f);
}

function confirm(id) {
    var confirm = document.getElementById("con" + id).classList = "col-12 col-lg-6 btn btn-warning m-1 d-none"
    var tick = document.getElementById("tick" + id).classList = "bi bi-check-circle text-success d-block"

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t !== "Success") {
                alert(t);
            } else {
                window.location.reload();
            }
        }


    }

    r.open("GET", "status1.php?id=" + id, true);
    r.send();


}

function confirm1(id) {
    var confirm = document.getElementById("con" + id).classList = "col-12 col-lg-6 btn btn-warning m-1 d-none"
    var tick = document.getElementById("tick" + id).classList = "bi bi-check-circle text-success d-block"

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }


    }

    r.open("GET", "status2.php?id=" + id, true);
    r.send();


}

function delivered(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }


    }

    r.open("GET", "status3.php?id=" + id, true);
    r.send();


}

function deletePurchase(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            } else {
                alert(t);
            }


        }


    }

    r.open("GET", "deletePurchase.php?id=" + id, true);
    r.send();


}

function deleteRecords(mobile) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            } else {
                alert(t);
            }


        }


    }

    r.open("GET", "deletePurchase1.php?mobile=" + mobile, true);
    r.send();


}

function focusNext(id) {


    var field = document.getElementById("max" + id).value.length;


    if (field >= 1) {
        id = parseInt(id) + 1;

        document.getElementById("max" + id).focus();
        if (id == 9) {
            verifyCode();
        }
    }
}

function verifyCode() {
    var a = document.getElementById("max1").value;
    var b = document.getElementById("max2").value;
    var c = document.getElementById("max3").value;
    var d = document.getElementById("max4").value;
    var e = document.getElementById("max5").value;
    var f = document.getElementById("max6").value;
    var g = document.getElementById("max7").value;
    var h = document.getElementById("max8").value;
    var vcode = a + b + c + d + e + f + g + h;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Done") {
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }




        }


    }

    r.open("GET", "codeVerify.php?vcode=" + vcode, true);
    r.send();

}

function adminVerify() {
    var email = document.getElementById("email").value;
    var x = Math.random();
    var y = x * 100000000;
    var code = Math.floor(y);
    if (code.length > 8) {
        code = "0" + code;
    }
    var f = new FormData();
    f.append("code", code);
    f.append("email", email);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("e").classList = "col-12 d-none";
                document.getElementById("p").classList = "col-12 d-block";
                document.getElementById("but").classList = "btn btn-success d-none";

            } else {
                alert(t);
            }


        }


    }

    r.open("POST", "adminVerify.php", true);
    r.send(f);
}

function buyAll() {


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;

            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please Login or Sign Up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your Profile First");
                window.location = "profile.php";
            } else {

                // Payment completed. It can be a successful failure.

                payhere.onCompleted = function onCompleted(orderId) {

                    saveInvoice1(orderId, mail, amount);
                    console.log("Payment completed. OrderID:" + orderId);

                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed

                payhere.onDismissed = function onDismissed() {

                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {

                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221108", // Replace your Merchant ID
                    "return_url": "http://localhost/soopervegan/cart.php", // Important
                    "cancel_url": "http://localhost/soopervegan/cart.php", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
            };
        }


    }


    r.open("GET", "buyAll.php", true);
    r.send();

}

function saveInvoice1(orderId, mail, amount) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("m", mail);
    f.append("a", amount);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "saveInvoice1.php", true);
    r.send(f);
}

function contactUs2(event) {
    if (event.keyCode == 13) {
        contactUs();
    }
}

function contactUs() {
    var msg = document.getElementById("messg").value;


    var f = new FormData();
    f.append("messg", msg);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location.reload();
            }

        }
    }
    r.open("POST", "contactUs.php", true);
    r.send(f);
}

function userSearch() {
    var user = document.getElementById("user").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("bod").innerHTML = t;

        }
    }
    r.open("GET", "userSearchProcess.php?user=" + user, true);
    r.send();


}

function findSellings() {
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var f = new FormData();
    f.append("from", from);
    f.append("to", to);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("bod").innerHTML = t;


        }
    }
    r.open("POST", "findSellings.php", true);
    r.send(f);



}

var mod1;

function payModalDisplay(id) {
    var qty = document.getElementById("qty").value;
    var price = id;
    var y = parseInt(qty) * parseInt(price);
    document.getElementById("setPrice").innerHTML = "Rs. " + y + ".00";
    var payModal = document.getElementById("payModal");
    mod1 = new bootstrap.Modal(payModal);
    mod1.show();

}

var mod2;

function payModalDisplay2() {

    var payModal1 = document.getElementById("payModal1");
    mod2 = new bootstrap.Modal(payModal1);
    mod1.hide();
    mod2.show();

}

var mod3;

function payModalDisplay3() {

    var payModal2 = document.getElementById("payModal2");
    mod3 = new bootstrap.Modal(payModal2);
    mod2.hide();
    mod3.show();

}

function payModalDisplay4(id) {
    var qty = document.getElementById("qty").value;
    mod3.hide();
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;
            alert(t);
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];
            var orderId = obj["id"];

            if (t == "1") {
                alert("Please Login or Sign Up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your Profile First");
                window.location = "userProfile.php";
            } else {
                alert("ok1");
                saveInvoice3(orderId, id, mail, amount, qty);
            }

        }
    }
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice3(orderId, id, mail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

function addNewProduct() {

    var pname = document.getElementById("pname").value;
    var pdescription = document.getElementById("pdescription").value;
    var ptype = document.getElementById("ptype").value;
    var pprice = document.getElementById("pprice").value;
    var pimage = document.getElementById("productPic");

    var f = new FormData();
    f.append("pname", pname);
    f.append("pdescription", pdescription);
    f.append("ptype", ptype);
    f.append("pprice", pprice);

    if (pimage.files.length == 0) {
        alert("done2");
        alert("You have not selected a profile image");
    } else {
        f.append("pimage", pimage.files[0]);

    }


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

        }
    }
    r.open("POST", "addProductProcess.php", true);
    r.send(f);


}