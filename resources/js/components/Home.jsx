import React, {useState, useEffect} from 'react';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

import {Link} from 'react-router-dom';

import Header from './partials/Header';
import Search from './partials/Search';
import Footer from './partials/Footer';

const Home = () => {

    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);


    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [results, setResults] = useState([]);
    const [categories, setCategories] = useState([]);


    const fetchItems = async (apiUrl = `/api/categories`) =>  {
        // console.log("load");
                await fetch(apiUrl, {signal})
                    .then(async (response) => {
                        
                        //throw errors if issues
                        if (response.status === 500) {
                            console.log("500");
                        }
                        else if(response.status === 404) {
                            console.log("404");
                        }
                        else if(response.status === 419) {
                            console.log("419");
                        }
        
                        const data = await response.json();

                        setResults(data);

                        setCategories(data.categories);
                        setLoading(false);
                })
            }

    useEffect(() => {
        if (loading) {fetchItems()}
        return () => {
            controller.abort();
        };
    }, [loading])

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
                                I'm James (commonly known as Jimjam).
                                </p>
                                <p>
I'm into web programming (with PHP and JS), making games in Unity (with C#), non-machine people languages (specifically Russian and Mandarin) and Linux/Unix nerd stuff. I mostly post about programming projects here as a record of what I've worked on.
</p>
<p>
As of September 2020, I study Computer Science at Aston University, Birmingham.
                            </p>
                      
                        </div>
                        <div className="homepage-right">
                            <img className="homepage-profile-pic" src="/portrait.png" alt="It's me" />

                            
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
                        <h2>Topics</h2>
                        <ul className="homepage-topic-links">
                            {loading ? <div className="spinner"><ClipLoader /></div> : 
                            categories.map((category) => {
                                return (
                                    <li key={category.id} >
                                    <Link to={"/category/" + category.title} dangerouslySetInnerHTML={{__html: category.emoji_name}}>
                                       
                                    </Link>
                                    </li>
                                )
                            })
                            }
                            </ul>
                        </div>

                        {/* 
                        // Old topics placeholder
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
 */}


                    </div>


                    
                   
            </div>


            }
            

            <Footer />
        </main>
            
        </div>
    );
}

export default Home;