import React, {useState, useEffect} from 'react';
 


const Search = (props) => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    const [loading, setLoading] = useState(true)

    const [search, setSearch] = useState("");
    const [allPosts, setAllPosts] = useState({})
    const [results, setResults] = useState({})



    const fetchItems = async (apiUrl = `https://www.jsparrow.uk/api/posts`) =>  {
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
            {search ?


            <main>
                    <h1>Search Results for "{search}"</h1>
                    {loading ? "loading..." : 
                        <div>
                            {results == 0 ? "No results found ;(" : 
                                results.map((post) => {
                                    return <div key={post.id}>
                                        <h2>{post.title}</h2>
                                        </div>
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