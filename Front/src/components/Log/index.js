// == Import
import './styles.scss';
import { useDispatch, useSelector } from 'react-redux';
import React, { useState } from 'react';
import { useQuery } from 'react-query';
import { signup } from './requete';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { setUserIsConnected } from '../../actions/actions';
import { Redirect, Route, NavLink } from "react-router-dom";


// == Composant
const Log = () => {  
  const dispatch = useDispatch();
  const url = 'http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public';
  const axios = require('axios');
  const notifySuccess = () => toast.success('Vous êtes maintenant inscrit !', {
    position: "top-center",
    autoClose: 5000,
    hideProgressBar: false,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    progress: undefined,
    });
    const notifySuccessLogin = () => toast.success('Vous êtes maintenant connecté !', {
      position: "top-center",
      autoClose: 5000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: true,
      draggable: true,
      progress: undefined,
      });
  const notifyError = () => toast.error("L'inscription a échouée", {
    position: "top-center",
    autoClose: 5000,
    hideProgressBar: false,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    progress: undefined,
    });  
  const notifyErrorLogin = () => toast.error("La connexion a échouée", {
    position: "top-center",
    autoClose: 5000,
    hideProgressBar: false,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    progress: undefined,
    });  
    
  const [emailLogin, setEmailLogin] = useState('');  
  const [passwordLogin, setPasswordLogin] = useState('');
  const [errorMessageLogin, setErrorMessageLogin] = useState('');

  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [password2, setPassword2] = useState('');
  const [address, setAddress] = useState('');
  const [zipcode, setZipcode] = useState('');

  const [errorMessage, setErrorMessage] = useState('');

  const handleSubmitLogin = (event) => {
    event.preventDefault();
    axios.post(url + "/api/login_check",
      {
        username: emailLogin,
        password: passwordLogin,
      },
      {
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
        },
      }
    )
    .then(function (response) {
      // handle success
      window.location.href = '/'

      console.log(response);
      notifySuccessLogin();
      sessionStorage.setItem('token', response.data.token);
      dispatch(setUserIsConnected(true));
    
      axios.get(`http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public/api/user`)
        .then(function (response) {
          console.log(response.data);
          const userInfo = response.data.find(i => i.email == emailLogin);
          sessionStorage.setItem('userInfo', JSON.stringify(userInfo));
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });

      
    })
    .catch(function (error) {
      // handle error
      console.log(error);
      notifyErrorLogin();
    });
  }
  const handleSubmit = (event) => {
    setErrorMessage('');
    event.preventDefault();

    if(name === '' || email === '' || password === '' || password2 === '' || address === '' || zipcode === ''){
      setErrorMessage('Tous les champs doivent êtres remplis');
    }
    else if(name.length < 3){setErrorMessage('Le nom doit contenir au moins 3 caractères');}
    else if(password.length < 4){setErrorMessage('Le mot de passe doit contenir au moins 4 caractères');}
    else if(password !== password2){setErrorMessage('Les mots de passe doivent êtres identiques');}
    else if(address.length < 3){setErrorMessage('L\'adresse doit contenir au moins trois caractères');}
    else if(zipcode.length !== 5){setErrorMessage('Le code postal doit contenir 5 caractères');}
    
    else{
      console.log('envoie requete inscription')
      axios.post(url + '/api/user', JSON.stringify(
        {
            "name": name,
            "email": email,
            "password": password,
            "address": address,
            "zip_code": parseInt(zipcode) 
        }
    ))
    .then(function (response) {
      // handle success
      console.log(response);
      notifySuccess();
    })
    .catch(function (error) {
      // handle error
      console.log(error);
      notifyError();
    })
    }
  }

  const [connexion, setconnexion] = useState(false);

  const classToggle = () => {
    setconnexion(!connexion)
  }
  
return (
  <div className="log">
    <ToastContainer
      position="top-center"
      autoClose={5000}
      hideProgressBar={false}
      newestOnTop={false}
      closeOnClick
      rtl={false}
      pauseOnFocusLoss
      draggable
      pauseOnHover
      limit={1}
    />

    <div className={`${connexion ? 'Inscription' : 'Connexion'}`} >
    <button className='btn-toggles' onClick={classToggle} >{`${connexion ? 'Inscription' : 'Connexion'}`}</button>

    <div className="wrapper-signup">
      <form className="signup" onSubmit={handleSubmit}>
        <h3>Inscription</h3>
        <p>Inscrivez vous pour recevoir votre petit dej chez vous</p>
        <div className="wrapper-inputs">
          <input
            type="text"
            className="input-form"
            placeholder="Nom"
            onChange={(event) => {
              setName(event.target.value);
            }}
          />
          <input
            type="email"
            className="input-form"
            placeholder="Email"
            onChange={(event) => {
              setEmail(event.target.value);
            }}
          />
          <input
            type="password"
            className="input-form"
            placeholder="Mot de passe"
            onChange={(event) => {
              setPassword(event.target.value);
            }}
          />
          <input
            type="password"
            className="input-form"
            placeholder="Mot de passe"
            onChange={(event) => {
              setPassword2(event.target.value);
            }}
          />
          <input
            type="text"
            className="input-form"
            placeholder="Adresse"
            onChange={(event) => {
              setAddress(event.target.value);
            }}
          />
          <input
            type="text"
            className="input-form"
            placeholder="Code postal"
            onChange={(event) => {
              setZipcode(event.target.value);
            }}
          />
        </div>
        <input type="submit" value="S'inscrire" className="btn-form" />
        <span className='error-text'>{errorMessage}</span>
      </form>


              

      <form className="signin" onSubmit={handleSubmitLogin}>

        <h3>Connexion</h3>
        <p>Connectez vous à votre compte</p>
        <div className="wrapper-input">
          <input
            type="email"
            className="input-form"
            placeholder="Email"
            onChange={(event) => {
              setEmailLogin(event.target.value);
            }}
          />
          <input
            type="password"
            className="input-form"
            placeholder="Mot de passe"
            onChange={(event) => {
              setPasswordLogin(event.target.value);
            }}
          />
        </div>


        <input
          type="submit"
          value="Se connecter"
          className="btn-form"
        />

        <span className='error-text-login'>{errorMessageLogin}</span>

      </form>

    </div>
    </div>
  </div>
);


};
  

// == Export
export default Log;
