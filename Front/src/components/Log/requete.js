const axios = require('axios');
 
export function signup (nameValue, emailValue, passwordValue, addressValue, zipcodeValue) {
    return axios.post('http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public/api/user', JSON.stringify(
        {
            "name": nameValue,
            "email": emailValue,
            "password": passwordValue,
            "address": addressValue,
            "zip_code": zipcodeValue
        }
    ))
}