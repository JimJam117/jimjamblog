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
    const [categories, setCategories] = useState([]);


    const fetchItems = async (apiUrl = `/api/categories`) =>  {
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
                loading ? <div className="spinner"><ClipLoader /></div> : 
                <div className="container">
                   <div>
                        <h2>Topics (placeholder, will become a list of categories)</h2>
                        <ul className="homepage-quick-links">


                        {categories.map((category) => {
                            return (
                                <li key={category.id} >
                                <Link to={"/category/" + category.title} dangerouslySetInnerHTML={{__html: category.emoji_name}}>
                                   
                                </Link>
                                </li>
                            )
                        })}


                                


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