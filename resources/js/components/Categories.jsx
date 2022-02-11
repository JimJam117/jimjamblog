import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import Header from './partials/Header';
import Footer from './partials/Footer';
import Search from './partials/Search';
import Sidebar from './partials/Sidebar';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

const Categories = () => {


    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);


    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [results, setResults] = useState([]);
    const [posts, setPosts] = useState([]);

    // pagination state
    const [currentPage, setCurrentPage] = useState();
    const [lastPage, setLastPage] = useState();

    // pagination function
    const changePage = (pageToChangeTo) => {
        if(pageToChangeTo < 1 || pageToChangeTo > lastPage){
            console.log("Page to change to: " + pageToChangeTo + " is not within boundries");
        }
        else {
            setCurrentPage(pageToChangeTo);
            setLoading(true);
        }
    }


    const fetchItems = async (apiUrl = `/api/posts?page=${currentPage}`) =>  {
        console.log("load");
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

                        console.log(currentPage);
                        setResults(data);

                        setCurrentPage(data.posts.current_page);
                        setLastPage(data.posts.last_page);

                        setPosts(data.posts.data);
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
                loading ? <div className="spinner"><ClipLoader /></div> : 
                <div className="container">
                   <div>
                        <h2>Topics (placeholder, will become a list of categories)</h2>
                        <ul className="homepage-quick-links">
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
                
                    <Sidebar recent={results.recent_post}/>
                    </div>
                }

            <Footer />
        </main>
            
        </div>
    );
}

export default Categories;