// == Import
import './styles.scss';
import { useSelector, useDispatch } from 'react-redux';
import { NavLink } from 'react-router-dom';
import { useState } from 'react';
import { BsInstagram } from 'react-icons/bs';
import { BsTwitter } from 'react-icons/bs';
import { BsFacebook } from 'react-icons/bs';

const Footer = () => {

    return (
        <footer className="footer">
            <div className="footer-links">

                <div className="footer-navbar">
                    <NavLink to='/legals' className="nav-link nav-link-legals" onClick={() => {
                    }}><p className="icon-footer" />Mentions Légales</NavLink>

                    <NavLink to='/blog' className="nav-link nav-link-blog" onClick={() => {
                    }}><p className="icon-footer" />Blog</NavLink>

                    <NavLink to='/help' className="nav-link nav-link-help" onClick={() => {
                    }}><p className="icon-footer" />Aide</NavLink>

                    <NavLink to='/about' className="nav-link nav-link-about" onClick={() => {
                    }}><p className="icon-footer" />A propos</NavLink>
                </div>

                <div className='socials-icons'>
                    <div className='socials'>
                    <BsInstagram className='social'></BsInstagram>
                    <BsTwitter className='social'></BsTwitter>
                    <BsFacebook className='social'></BsFacebook>
                    </div>
                    <div className='copyright'>
                    <p>© 2022 Break'Fast - <NavLink to='/about'>Team</NavLink></p>
                    </div>
                </div>
            </div>
        </footer>
    );
}

// == Export
export default Footer;
