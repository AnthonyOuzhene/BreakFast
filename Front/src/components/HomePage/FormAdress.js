// == Import
import './styles.scss';
import { useSelector, useDispatch } from 'react-redux';
import { changeInputValue, setAdress } from 'src/actions/actions';
import { useQuery } from 'react-query';
import { searchCity } from './requete';
import ProposedField from './ProposedField';
import { useNavigate } from 'react-router-dom';

// == Composant
const FormAdress = () => {
  const navigate = useNavigate();

  const inputValue = useSelector((state) => state.inputAdress);
  const currentAdress = useSelector((state) => state.currentAdress);
  /* console.log() */
  const dispatch = useDispatch();
    
  const queryKey = ['search', inputValue];
  const {isLoading, data, error} = useQuery(queryKey, () => searchCity(inputValue), {
    refetchOnWindowFocus: false,
  })
  const requete = data || false;

  console.log(requete);
  

  return (
    <div className="box-form-adresse">
      <h2 className="form-title">Où êtes vous ?</h2>
      <form
        className="form-adresse"
        onSubmit={(event) => {
          event.preventDefault();
          const action  = setAdress(inputValue);
          dispatch(action);
        }}
      >
        <input 
          type="text"
          className="form-adresse-input"
          placeholder="Entrez votre adresse"
          value={inputValue}
          onChange={(event) => {
            const action  = changeInputValue(event.target.value);
            dispatch(action);
          }}
        />
        <ul className='listPropositions'>
          {!isLoading && requete.data.map((item) => (
            <ProposedField
              key={item.code}
              name={item.nom}
            />
          ))}
        </ul>
      </form>
    </div>
  );
};

// == Export
export default FormAdress;
