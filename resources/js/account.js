import "select2/dist/css/select2.min.css";
import $ from "jquery";
import select2 from "select2";
select2();
import showMessage from "./message";

const updateBtn = document.querySelector(".update-profile-btn");
let confirmUpdateBtn = document.querySelector(".confirm-update-btn");
const delBtn = document.querySelector(".delete-profile-btn");
const profileForm = document.querySelector(".profile-form");
const profileTable = document.querySelector(".profile-table");
if (updateBtn) {
    const toggleVisibility = (element, condition) => {
        element.classList.toggle("d-none", !condition);
    };

    const renderBtn = () => {
        const isForm = status === "form";
        toggleVisibility(updateBtn, !isForm);
        toggleVisibility(confirmUpdateBtn, isForm);
        toggleVisibility(delBtn, isForm);
        toggleVisibility(profileForm, isForm);
        toggleVisibility(profileTable, !isForm);
    };
    let status = "table";
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        status = status === "table" ? "form" : "table";
        renderBtn();
    });
    delBtn.addEventListener("click", function (e) {
        e.preventDefault();
        status = "table";
        renderBtn();
    });
}

if (profileForm) {
    const updateProfile = async (formData, csrfToken) => {
        try {
            confirmUpdateBtn.innerHTML = "Đang cập nhật...";
            confirmUpdateBtn.setAttribute("disabled", true);
            const response = await fetch("/tai-khoan/thong-tin", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(formData),
            });
            const { success, errors } = await response.json();
            confirmUpdateBtn.innerHTML = "Cập nhật";
            confirmUpdateBtn.removeAttribute("disabled");
            if (errors) {
                showErrors(errors);
            } else {
                showMessage("Cập nhật thành công", "success");
            }
        } catch (error) {
            console.error(error);
        }
    };
    const showErrors = (errors) => {
        const errorList = profileForm.querySelectorAll(".error");
        errorList.forEach((error) => {
            error.innerHTML = "";
        });
        Object.keys(errors).forEach((key) => {
            const error = profileForm.querySelector(`.error-${key}`);
            if (error) {
                error.innerHTML = errors[key][0];
            }
        });
    };
    profileForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = Object.fromEntries(new FormData(e.target));
        const csrfToken = document.head.querySelector(
            '[name="csrf-token"]'
        ).content;
        updateProfile(formData, csrfToken);
    });
    delBtn.addEventListener("click", function (e) {
        e.preventDefault();
        window.history.back();
        location.reload();
    });
}

//Select2
$(".js-select2").select2();
