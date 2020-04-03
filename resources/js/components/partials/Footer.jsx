import React from 'react';

import {Link} from 'react-router-dom';

const Footer = () => {

    const redirect = url => window.location = url;

    return (
        <footer>
            <div className="footer-buttons">
            <Link to="/github" aria-label="Github"  type="button" className="social-button social-button-github">
                <i className="fab fa-github"></i>
            </Link>
            <Link to="contact" aria-label="Contact" type="button" className="social-button" name="button">
                <i className="fas fa-envelope"></i>
            </Link>
            </div>

            <div className="footer-email">jamessparrow101@googlemail.com</div>
        </footer>
   
    );
}

export default Footer;