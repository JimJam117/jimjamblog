import React, {useState, useEffect} from 'react';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

import {Link} from 'react-router-dom';


const LatestPosts = () => {

    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);


    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [posts, setPosts] = useState([]);
    //const [categories, setCategories] = useState([]);

    const fetchItems = async (apiUrl = `/api/posts?page=${1}`) =>  {
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

                        
                        // setResults(data);

                        // setCurrentPage(data.posts.current_page);
                        // setLastPage(data.posts.last_page);

                        setPosts(data.posts.data);
                        //setCategories(data.categories.data)

  
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
        
        <>
                                <ul className="homepage-quick-links">
                            {loading ? <div className="spinner"><ClipLoader /></div> : 

                            posts.map((post) => { 
                                return <li key={post.id}><Link to={"/post/" + post.slug}>{post.title}</Link></li>
                            })}
                            <li style={{listStyle: 'none'}}> <Link to={"/posts"}><em>...view more</em></Link></li>
                            
                            </ul>

      
        </>

                            
                        

    );
}

export default LatestPosts;