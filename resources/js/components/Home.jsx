import React, {useState} from 'react';

import {Link} from 'react-router-dom';

import Header from './partials/Header';
import Search from './partials/Search';
import Footer from './partials/Footer';

const Home = () => {

    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);

    return (
        <div className="main-container">
            <Header />

        <main>

            <Search display={searchDisplay} setDisplay={setDisplay}/>
            
            {searchDisplay ? null : 
            
            <div>
                    {/* <div className="banner"><h1>Welcome!</h1></div> */}
    
                    <div className="homepage-content">
                    
                        
                            {/* <img className="homepage-profile-pic-top" src="/img/jimjam3.png" alt="Me" /> */}
                            <p className="homepage-content-title">
                                {/* <img className="homepage-profile-pic" src="/img/jimjam3.png" alt="Me" /> */}
                                Hi, I'm James (commonly known as Jimjam). 
                            </p>
                            <p>
                                I'm into web programming (with PHP and JS), making games in Unity (with C#), non-machine people languages (specifically Russian and Mandarin) and Linux/Unix nerd stuff. I mostly post about programming projects here as a record of what I've worked on. 
                            </p>
                            <p>
                                As of September 2020, I study Computer Science at Aston University, Birmingham.
                            </p>
                            <ul className="homepage-quick-links">
                                <li><Link to="/blog"><i className="fas fa-pen"></i> Blog</Link></li>
                                {/* <li><Link to="/blog/projects"><i className="fas fa-project-diagram"></i> Projects</Link></li> */}
                                <li><Link to="/portfolio"><i className="far fa-gem"></i> Portfolio</Link></li>
                                <li><Link to="/github"><i className="fab fa-github"></i> Github</Link></li>
                                <li><Link to="/contact"><i className="fas fa-envelope"></i> Contact</Link></li>
                            </ul>
                        {/* </div> */}
                        {/* <div className="homepage-gallery">

                            <img src="/img/logos/htmlcssjs.png" alt="" />
                            <img src="/img/logos/php.png" alt="" />
                            <img src="/img/logos/lamp.png" alt="" />
                            <img src="/img/logos/laravel.png" alt="" />
                            <img src="/img/logos/c-sharp.png" alt=""/>
                            <img src="/img/logos/unity.png" alt="" />

                        </div> */}
                    </div>
            </div>


            }
            

            <Footer />
        </main>
            
        </div>
    );
}

export default Home;