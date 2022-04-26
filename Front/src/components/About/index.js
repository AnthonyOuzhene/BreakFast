// == Import
import './styles.scss';

import sly from 'src/components/About/images/ratonlaveur.png'
import superman from 'src/components/About/images/Superman.jpg'
import batman from 'src/components/About/images/batman.jpg'
import harley from 'src/components/About/images/harley.png'
import wonder from 'src/components/About/images/wonderWoman.jpg'
import deadpool from 'src/components/About/images/deadpool.jpg'
import flash from 'src/components/About/images/flash.jpg'



// == Composant
const About = () => (
  <div className="about">
    <div className='front' >
    <h1>Team Front :</h1>
      <div className='Personne' >
        <img  src={wonder} style={{'margin-bottom':'-20px'}}  alt='pp'/>
        <h2>Karen Maciel</h2>
        <h3>Référent Technique</h3>
      </div>
      <div className='Personne' >
        <img  src={superman} className='deadpool' alt='pp'/>
        <h2>Loris Beranger</h2>
        <h3>Lead Dev Front</h3>
      </div>
      <div className='Personne' >
        <img  src={flash} className='sly' alt='idk'/>
        <h2>Mathys Vitiello</h2>
        <h3>Git Master</h3>
        </div>
      </div>

      <div className='back' >
      <h1>Team Back :</h1>
      <div className='Personne' >
        <img src={harley} className="harley" alt='pp'/>
        <h2>Alexandra Gonçalves</h2>
        <h3>Lead Dev Back / Scrum Master</h3>
      </div>
      <div className='Personne' >
        <img  src={batman} className='batman' style={{'margin-bottom':'-20px'}} alt='pp'/>
        <h2>Anthony Ouzhene</h2>
        <h3>Product Owner</h3>
      </div>
    </div>
  </div>
);

// == Export
export default About;
