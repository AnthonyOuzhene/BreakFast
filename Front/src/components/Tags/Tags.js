import bio from './images/bio.png';
import glutenfree from './images/glutenfree.png';
import organic from './images/organic.png';
import vegan from './images/vegan.png';

import './styles.scss';

const Tags = () => {

  return (
    <div className="tags">

      <div className="tag">
        <img className="tag__img" src={bio} alt="logo bio" />
      </div>
      <div className="tag">
        <img className="tag__img" src={glutenfree} alt="logo gluten free" />
      </div>
      <div className="tag">
        <img className="tag__img" src={organic} alt="logo organic" />
      </div>
      <div className="tag">
        <img className="tag__img" src={vegan} alt="logo vegan" />
      </div>

    </div>
  );
};

export default Tags;
