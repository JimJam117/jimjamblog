import React, {useState, useEffect} from 'react';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

import {Link} from 'react-router-dom';

import Header from './partials/Header';
import Search from './partials/Search';
import Footer from './partials/Footer';
import LatestPost from './partials/LatestPost';
import LatestPosts from './partials/LatestPosts';

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

                            <h1>Bonjour</h1>
                             


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


                    <div>
                            <h2>Projects</h2>
                            <hr />
                            <br />
                            <ul className="homepage-quick-links">
                                <li><a href="https://hanzibase.net"><i className="icon hanzibase-icon"></i> Hanzibase: </a>
                                 <span> </span> A web application database of Chinese characters, made with Laravel and React.</li>
                                <li><a href="/category/Uni Projects">🎓 Uni Projects: </a>
                                 <span> </span> See all the projects I have done at Uni.</li>
                                {/* <li><a href="/category/Hong Kong 47"><i className="icon hk47-icon"></i> Hong Kong 47</a><strong>:</strong> <span>
                                Doom/Wolfenstien style first person shooter, developed in Unity.
                                    </span></li> */}
                                
                            </ul>
                            
                            <br />
                            <p>... and more to come!</p>

                        </div>

                        <div>
                        <h2>Blog Posts</h2>
                        <hr />
                        <br />
                            <LatestPosts></LatestPosts>
                            
                        

                        
                   
                            
                        </div>
                        <hr />

                    </div>
                    <div className='homepage-content'>
                        <div>
                        <h2>Topics</h2>
                        <hr />
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

                        </div>
                 

                    
                   
            </div>


            }
            

            <Footer />
        </main>
            
        </div>
    );
}

export default Home;