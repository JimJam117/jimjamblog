import React from 'react';

import {Link} from 'react-router-dom';

const Header = () => {
    return (
            <header className="topbar">
                <div className="topbar-section">
                    <div className="title">
                        <h1>James Sparrow</h1>
                        <h3>Web Developer</h3>
                    </div>

                    <nav className="navbar">
                        <Link to="/home">Home</Link>
                        <Link to="/posts">Blog</Link>
                        <Link to="/portfolio">Portfolio</Link>
                    </nav>    
                </div>
            </header>
    );
}

export default Header;