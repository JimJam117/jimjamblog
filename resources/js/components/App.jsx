
 import React from 'react';
import ReactDOM from 'react-dom';

export default App = (props) => {
    
        return (

            <div style={{'backgroundColor' : 'blue',}}>
                <div className="topbar">
                    <div className="topbar-section">
                    <div className="title">
                        <h1>James Sparrow</h1>
                        <h3>Web Developer</h3>
                    </div>
                    <nav className="navbar">
                        <a href="/home">Home</a>
                        <a href="/posts">Blog</a>
                        <a href="/portfolio">Portfolio</a>
                    </nav>    
                </div>
                </div>



                <div className="main">
                    {/* @yield('content') */}
                    {props.content}
                    <hr />
                    <footer> 
                        <button aria-label="Github" onclick="location.href='/github';" type="button" className="social-button social-button-github">
                            <i className="fab fa-github"></i>
                        </button>
                        <button aria-label="Contact" onclick="location.href='/contact';" type="button" className="social-button" name="button">
                            <i className="fas fa-envelope"></i>
                        </button>
                            jamessparrow101@googlemail.com</footer>
                </div>
            </div>

        );
    
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
