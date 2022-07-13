import React, {useState, useEffect} from 'react';

import { css } from "@emotion/core";
import ClipLoader from "react-spinners/ClipLoader";

import {Link} from 'react-router-dom';


const LatestPost = () => {

    const [searchDisplay, setSearchDisplay] = useState(false);
    const setDisplay = (input) => setSearchDisplay(input);


    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [post, setPost] = useState({});

    const fetchItem = async (apiUrl = `/api/post_latest`) =>  {
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
                        if (response.status !== 200) {
                            console.log(response.status);
                        }
        
                        const data = await response.json();

                        setPost(data.post);
                        console.log(data);
                        setLoading(false);
                })
            }

    useEffect(() => {
        if (loading) {fetchItem()}
        return () => {
            controller.abort();
        };
    }, [loading])





    return (
        
                        <ul className="homepage-quick-links">
                            {loading ? <div className="spinner"><ClipLoader /></div> : 
                            // <Link key={post.id} to={"/post/" + post.slug} className="unlinkStyle">
                            //     <article className="section post_link">
                            //         <img className="post_thumbnail" src={post.image} alt={post.title} />

                            //             <div className="post_container">
                            //                 <p className="timestamp">{post.created_at}</p>
                            //                 <h2 className="post_title">{post.title}</h2>
                            //                     {/* Strip the body of tags and get the first 200 characters */}
                            //                 <p>{(post.body.replace(/(<([^>]+)>)/ig,"").substring(0,200) + "...")}</p>
                            //             </div>
                            //         </article>
                            //     </Link>
                            <li><Link to={"/post/" + post.slug}>{post.title}</Link></li>
                            }
                            </ul>
                        

    );
}

export default LatestPost;