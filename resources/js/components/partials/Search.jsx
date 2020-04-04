import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';


const Search = (props) => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    const [loading, setLoading] = useState(true)

    const [search, setSearch] = useState("");
    const [allPosts, setAllPosts] = useState([])
    const [results, setResults] = useState([])



    const fetchItems = async (apiUrl = `/api/posts`) =>  {
        console.log("load");
                await fetch(apiUrl, signal)
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

                        setAllPosts(data.posts.data);
                        setLoading(false);
                })
            }

    useEffect(() => {
        if (loading) {fetchItems()}
        return () => {
            controller.abort();
        };
    }, [loading])

    useEffect(() => {
        if (!loading) {
            setSearchResults(search);
        }
    }, [search, loading])

    const reset = (e) => {
        console.log("reset");
        setSearch("");
        props.setDisplay(false);
    }
    
    const handleChange = (e) => {

        var inputValue = e.target.value;
        setSearch(e.target.value);
        //console.log("this is the search: " + search + " : " + inputValue)
        if(inputValue !== "" && props.display === false) {
            props.setDisplay(true);
        }
        else if (inputValue === "" && props.display === true) {
            props.setDisplay(false);
        }
    }

    const setSearchResults = (inputValue) => {
        // search stuff
        setResults(allPosts.filter((post) => {
            // the words in the title
            var titleWords = post.title.toLowerCase().split(" ");

            // the words in the body (with tags stripped)
            var body = post.body.replace(/(<([^>]+)>)/ig,"").toLowerCase();
            var bodyWords = body.split(" ");

            // title words + body words
            var words = titleWords.concat(bodyWords);
            
            // words in input
            //var inputWords = inputValue.split(" ");

            
            var containsString = false;

            // for each word in words, if it is like a word in input words, set containsString to true
            words.forEach(word => {
                //inputWords.forEach((inputWord) => {
                    if(word.includes(inputValue.toLowerCase()) == true) {
                        containsString = true;
                    }
                //})
            });

            // returns this post if true
            return containsString;
        }));
    }





    return (

        <div>
            <div className="form-group search">
                <form method="POST" action="/search" style={{'display': 'flex', 'justifyContent': 'end'}}>
                    <input type="hidden" name="_token" value="X1U09v2PexYHdViQdW2VLwBFID494f3po6dWLXPZ" />
                    {/* <button aria-label="Search" type="submit" className="searchButton"><i className="fa fa-search" aria-hidden="true"></i></button> */}
                    <div aria-label="Search" type="submit" className="searchButton"><i className="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" name="query" className="searchInput" id="search" placeholder="Search..." value={props.query} required onChange={(e) => handleChange(e)} />
                    <label style={{'display' : 'none' }} htmlFor="search">Search</label>
                </form>
            </div>
            {search !== "" ?


            <main>
                    <h1>Search Results for "{search}"</h1>
                    {loading ? "loading..." : 
                        <div>
                            {results == 0 ? "No results found ;(" : 
                                results.map((post) => {

                                    let isCurrentPost = false;
                                    if(typeof(props.currentId) !== 'undefined') {
                                        //console.log("is currednt!", props.currentId, post.slug);
                                        if (props.currentId == post.slug) {
                                            isCurrentPost = true;
                                            //console.log("is current!");
                                        }
                                        
                                        
                                    }

                                    return (
                                        <Link key={post.id} to={"/post/" + post.slug} onClick={isCurrentPost ? () => reset() : null} className="unlinkStyle">
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
                                })
                            }
                        </div>
                    }
            </main>    
            
            
            
            : null}
        </div>
    );
}

export default Search;