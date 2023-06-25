// Função para verificar valor vazio
function isEmpty(value) {
    return (value === null || value === undefined) || (typeof value === 'string' && value.trim() === '') ?
        true : false;
}

// Função para validar o formato do nome completo
function validateFullName(fullName) {
    let regex = /^\D*$/;
    return regex.test(fullName) && fullName.length <= 50;
}

// Função para validar o formato do e-mail
function validateEmail(email) {
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Função para validar o formato do telefone (1 a 11 dígitos)
function validatePhone(phone) {
    let regex = /^\d{1,11}$/;
    return regex.test(phone);
}  

// Função para validar o formato do CPF (11 dígitos)
function validateCPF(cpf) {
    let regex = /^\d{11}$/;
    return regex.test(cpf);
}