// == Import
import FormAdress from './FormAdress';
import './styles.scss';
import Categories from './Categories';


// == Composant
const HomePage = () => (
  <div className="homepage">
    <div className="section-form-adress">
      <FormAdress />
    </div>
    <Categories />
  </div>
);

// == Export
export default HomePage;
