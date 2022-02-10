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
                    <div className="banner"></div>
    
                    <div className="homepage-content">
                        <div className="homepage-left">
                            {/* <img className="homepage-profile-pic-top" src="/img/jimjam3.png" alt="Me" /> */}
                            {/* <p> */}
                                {/* <img className="homepage-profile-pic" src="/img/jimjam3.png" alt="Me" /> */}
                            
                            {/* </p> */}

                            <h2>Bonjaw</h2>
                            <small className="homepage-small-msg"><em>That's french for hello</em></small>
                            
                            <p>
                                Hi, I'm James (commonly known as Jimjam).
                                </p>
                                <p>
I'm into web programming (with PHP and JS), making games in Unity (with C#), non-machine people languages (specifically Russian and Mandarin) and Linux/Unix nerd stuff. I mostly post about programming projects here as a record of what I've worked on.
</p>
<p>
As of September 2020, I study Computer Science at Aston University, Birmingham.
                            </p>
                      
                        </div>
                        <div className="homepage-right">
                            <img className="homepage-profile-pic" src="/img/james4.jpg" alt="" />

                            
                        </div>
                    </div>


                    <div className="homepage-content">
                        <div>
                        <h2>Contact</h2>
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





                           
                        </div>

                        <div>
                        <h2>Topics (placeholder, will become a list of categories)</h2>
                        <ul className="homepage-topic-links">
                                <li><Link to="/blog/projects"><i className="icon hk47-icon"></i> Hong Kong 47</Link></li>
                                <li><Link to="/blog/projects"><i className="icon hanzibase-icon"></i> Hanzibase</Link></li>
                                <li><Link to="/blog/projects">🍴 Yummies</Link></li>
                                <li><Link to="/blog/projects">❤️ Personal Life</Link></li>
                                <li><Link to="/blog/projects">🐧 Linux</Link></li>
                                <li><Link to="/blog/projects">🤖 Jimjambot</Link></li>
                                <li><Link to="/blog/projects">📖 Library</Link></li>
                                <li><Link to="/blog/projects">🤔 Interesting Things</Link></li>
                                <li><Link to="/blog/projects">🌐 Web Programming</Link></li>


                            </ul>
                        </div>



                    </div>


                    
                   
            </div>


            }
            

            <Footer />
        </main>
            
        </div>
    );
}

export default Home;