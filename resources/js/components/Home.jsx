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
        console.log("load");
        console.log(apiUrl, {signal});
                await fetch(apiUrl, {
                    method: "GET",
                    signal: signal,
                    headers : { 
                      'Content-Type': 'text/html',
                      'Accept': 'text/html'
                   }})
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
                        else if (response.status !== 400) {
                            console.log(response.status);
                        }
        
                        const data = await response.json();

                        setResults(data);
                        console.log(data);
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

                            <h2>Bonjour</h2>
                             


                            <p>I'm James (commonly known as Jimjam).</p>

 <p>I’m a Computer Science student currently studying at UEA (University of East Anglia), although I have previously attended Aston University in Birmingham.  </p>
 <p>Here you’ll find a record of projects I’ve worked on, as well as any other ramblings I decide are acceptable enough to make public.  </p>




                      
                        </div>
                        <div className="homepage-right">
                            <img className="homepage-profile-pic" src="/portrait.png" alt="It's me" />
                            {/* <em><Link className="unlinkStyle" to="/post/pics">More pics of meh</Link></em>
                             */}
                        </div>
                    </div>


                    <div className="homepage-content">
                        <div className="homepage-contact">
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
                                
                                
                                {/* <li><a href="https://twitter.com/jimjamethon"><i className="fab fa-twitter"></i> Twitter</a></li> */}
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