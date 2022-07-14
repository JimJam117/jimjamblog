import React from 'react';

import {Link} from 'react-router-dom';

const Header = () => {
    return (
            <header className="topbar">
                <div className="topbar-section">
                <Link to="/home">
                    <div className="title">
                        <h1>jsparrow.uk</h1>
                    </div>
                </Link>

                    <nav className="navbar">
                        <Link to="/home">Home</Link>
                        <Link to="/posts">Blog</Link>
                        <Link to="/portfolio">CV / Portfolio</Link>
                    </nav>    
                </div>
            </header>
    );
}

export default Header;