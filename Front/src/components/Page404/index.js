// == Import
import { NavLink } from 'react-router-dom';
import './styles.scss';
import img404 from 'src/components/Page404/404.jpg'

// == Composant
const Page404 = () => {  
  
return (
  <div className='page404'>
    <div className='wrapper-404'>
      <h1 className='title-404'>4</h1>
      <img src='https://c.tenor.com/7IK5RB4FbhAAAAAC/shiba-ears-pop-up-in-bread.gif' className='gif'/>
      <h1 className='title-404'>4</h1>
    </div>
    <NavLink to='/' className='btn-home-404'>Retourner à l'accueil</NavLink>
  </div>
       
);
};
  

// == Export
export default Page404;
