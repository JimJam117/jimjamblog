import React from 'react';

import {Link} from 'react-router-dom';

const Footer = () => {

    const redirect = url => window.location = url;

    return (
        <footer>
            <div className="footer-buttons">
            <a href="/github" aria-label="Github"  type="button" className="social-button social-button-github">
                <i className="fab fa-github"></i>
            </a>
            <Link to="contact" aria-label="Contact" type="button" className="social-button" name="button">
                <i className="fas fa-envelope"></i>
            </Link>
            </div>
            <hr />
            <div className="bottom-links">
                   
                        <ul className="homepage-quick-links bottom-links">
                                <li><Link to="/posts"><i className="fas fa-pen"></i> Blog</Link></li>
                                {/* <li><Link to="/blog/projects"><i className="fas fa-project-diagram"></i> Projects</Link></li> */}
                                <li><Link to="/portfolio"><i className="far fa-gem"></i> Portfolio</Link></li>
                                <li><a href="/feed"><i className="fas fa-rss"></i> RSS</a></li>
                                <li><Link to="/contact"><i className="fas fa-envelope-square"></i> Contact</Link></li>
                                <li><a href="/github"><i className="fab fa-github"></i> Github</a></li>
                            </ul>
                        </div>

                    

            <div className="footer-email">jamessparrow101@googlemail.com</div>
        </footer>
   
    );
}

export default Footer;