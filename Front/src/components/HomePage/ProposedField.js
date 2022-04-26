// == Import
import './styles.scss';
import { useSelector, useDispatch } from 'react-redux';
import { changeInputValue } from 'src/actions/actions';

// == Composant
const ProposedField = ({ name }) => {
    const dispatch = useDispatch();

    return (
    <li className="proposedfield" onClick={(e) => {
        document.querySelector('.form-adresse-input').focus()
        console.log('name')
        const action  = changeInputValue(name);
        dispatch(action);
        
    }}>
        {name}
    </li>
    );
}

// == Export
export default ProposedField;
