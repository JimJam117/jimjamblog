import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import Header from './partials/Header';
import Footer from './partials/Footer';
import Search from './partials/Search';
import Sidebar from './partials/Sidebar';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

const Blog = () => {


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
            // console.log("Page to change to: " + pageToChangeTo + " is not within boundries");
        }
        else {
            setCurrentPage(pageToChangeTo);
            setLoading(true);
        }
    }


    const fetchItems = async (apiUrl = `/api/posts?page=${currentPage}`) =>  {
        // console.log("load");
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
        
                        const data = await response.json();

                        // console.log(currentPage);
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
                    <div className="posts_container">
                    <p className="page-num">Page {currentPage}</p>
                        {posts.map((post) => {
                            return (
                                <Link key={post.id} to={"/post/" + post.slug} className="unlinkStyle">
                                    <article className="section post_link">
                                        <img className="post_thumbnail" src={post.image} alt={post.title} />

                                        <div className="post_container">
                                            <p className="timestamp">{post.created_at}</p>
                                            <h2 className="post_title">{post.title}</h2>
                                                {/* Strip the body of tags and get the first 200 characters */}
                                            <p>{(post.body.replace(/(<([^>]+)>)/ig,"").substring(0,200) + "...")}</p>
                                        </div>
                                    </article>
                                </Link>
                            )
                        })}

                        {/* if the current page isn't 1, show last page button */}
                        {currentPage !== 1 ?
                            <button className="btn" onClick={() => changePage(currentPage - 1)}>Last Page</button> :
                            null
                        }

                        {/* if the current page isn't equal to the last page, show next page button */}
                        {currentPage !== lastPage ?
                            <button className="btn" onClick={() => changePage(currentPage + 1)}>Next Page</button> :
                            null
                        }
                        
                        {/* <p>Current Page: {currentPage}</p>
                        <p>Last Page: {lastPage}</p> */}
                    </div>
                
                    <Sidebar recent={results.recent_post}/>
                    </div>
                }

            <Footer />
        </main>
            
        </div>
    );
}

export default Blog;