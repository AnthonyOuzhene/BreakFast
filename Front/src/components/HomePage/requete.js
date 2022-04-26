const axios = require('axios');
 
export function searchCity (inputValue) {
    return axios.get('https://geo.api.gouv.fr/communes', {
        params: {
            nom: inputValue,
            boost: 'population',
            limit: 4,
        }
    })
}

