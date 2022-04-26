// == Import
import './styles.scss';


const Contact = () => {

  return (
    <div class="contact">
      <h1 id="contact-page__title">Contact</h1>

      <div class ="contact-form">
        <form class="contact-form__container">
          <label class="contact-form__label">
            Nom
            <input class="form-input" type="text" name="name" />
          </label>
          <label class="contact-form__label">
            Email
            <input class="form-input" type="text" name="name" />
          </label>
          <label class="contact-form__label" for="message">
            Message
            <textarea id="message" type="text" name="message"></textarea>
          </label>
          <input id="submit-form__button" type="submit" value="Envoyer" />
        </form>
      </div>
      

    </div>
  );
}

// == Export
export default Contact;
