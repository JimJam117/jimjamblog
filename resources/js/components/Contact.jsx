import React, {useState} from 'react';

import {Link} from 'react-router-dom';

import Header from './partials/Header';
import Footer from './partials/Footer';

import ReCAPTCHA from "react-google-recaptcha";

const Contact = () => {

    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [body, setBody] = useState("");
    const [captcha, setCaptcha] = useState();

    function onChange(value) {
        setCaptcha(value);
    }

    return (
        <div className="main-container">
            <Header />

        <main>
            <div className="banner"><h1>Contact</h1></div>

            <div className="homepage-content">
                        <div>
                        <div className="homepage-email-msg">
                        <h4>For serious business, please email:</h4>
                        <strong>jamessparrow101@googlemail.com</strong>
                        </div>
                        
                        <h4>Other Socials:</h4>
                        <ul className="homepage-quick-links">
                        <li><a href="/github"><i className="fab fa-github"></i> Github</a></li>
                        <li><a href="https://www.instagram.com/jimjamleman/"><i className="fab fa-instagram"></i> Instagram</a></li>
                                <li><a href="https://steamcommunity.com/id/JimJam117"><i className="fab fa-steam"></i> Steam</a></li>
                                <li><a href="https://discordapp.com/users/252471185864916992"><i className="fab fa-discord"></i> Discord</a></li>
                                
                                
                                <li><a href="https://twitter.com/jimjamethon"><i className="fab fa-twitter"></i> Twitter</a></li>
                            </ul>





                           
                        </div></div>

            <br /><br /><br />

            <Footer />
        </main>
            
        </div>
    );
}

export default Contact;
