import { showAlert, trans } from "../helpers";

export function validateForm(formData, requiredFields) {
    const errors = {};
    const nameFields = ["name", "lastName"];
    const numericFields = ["phone", "zipCode"];
    const passwordFields = ["password", "newPassword"];

    for (const field in formData) {
        const value = formData[field];
        const inputField = document.getElementById(field);

        if(inputField) {
            inputField.classList.remove('invalid_field');
        }

        if(requiredFields[field] && requiredFields[field].required) {
            if (!value.trim()) {
                errors[field] = trans('field_required_message', { attribute: requiredFields[field].label });
                inputField.classList.add('invalid_field');
                continue;
            }
        }

        if(field === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            errors[field] = trans('email_invalid_message');
        }

        if (nameFields.includes(field) && value.length && !/^[A-Za-zÀ-ÿ\s]+$/.test(value)) {
            inputField.classList.add('invalid_field');
            errors[field] = trans('field_invalid_character_message', { attribute: requiredFields[field].label});
        }

        if(numericFields.includes(field) && typeof value !== "number" && isNaN(value)) {
            inputField.classList.add('invalid_field');
            errors[field] = trans('field_invalid_numeric_message', { attribute: requiredFields[field].label});
        }
    }

    if (Object.keys(errors).length > 0) {
        const errorList = Object.values(errors)
            .map((error) => `- ${error}`)
            .join("<br>");

        showAlert("error", trans('invalid_fields'), errorList);
        return false;
    }

    return true;
}