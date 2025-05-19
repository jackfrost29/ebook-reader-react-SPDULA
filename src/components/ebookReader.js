import React from 'react';
import { useReducer, useRef, useState } from "react";

function reducer(state, action) {
    // prev
    // next
    // zoom-in
    // zoom-out
    // select-page-single
    // select-page-double
    // toggle-full-screen
    if (action.type === "prev") {
        if (state.no_of_pages === 1) return { ...state, page_no: state.page_no - 1 }
        else return { ...state, page_no: state.page_no - 2 }
    }
    else if (action.type.includes("next")) {
        if (state.no_of_pages === 1) return { ...state, page_no: state.page_no + 1 }
        else {
            // layout -> 2
            var p_arr_size = parseInt(action.type.split("#").splice(-1));
            if (state.page_no < p_arr_size - 1) {
                return { ...state, page_no: state.page_no + 2 }
            }
            else return state
        }

    }
    else if (action.type === "zoom-in") return { ...state, zoom: state.zoom + 5 }
    else if (action.type === "zoom-out") return { ...state, zoom: state.zoom - 5 }
    else if (action.type === "select-page-single") return { ...state, no_of_pages: 1 }
    else if (action.type === "select-page-double") {
        /* also have to consider the page count */
        var new_page_no = (state.page_no % 2) === 1 ? state.page_no : state.page_no - 1
        return { ...state, page_no: new_page_no, no_of_pages: 2 }
    }
    else if (action.type === "toggle-full-screen") {
        debugger;
        let elem = document.querySelector(".right-panel");

        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch((err) => {
                alert(
                    `Error attempting to enable fullscreen mode: ${err.message} (${err.name})`,
                );
                return state;
            });
            return { ...state, is_full_screen: !(state.is_full_screen) };
        } else {
            document.exitFullscreen();
            return { ...state, is_full_screen: !(state.is_full_screen) };
        }
    }
    return state

}
/* .right-panel
if (document.fullscreenElement) {
            document.exitFullscreen()
        }
        else {
            document.querySelector(".right-panel").requestFullscreen();
        }
        return { ...state, is_full_screen: !(state.is_full_screen) };
*/


function EbookReader() {
    const toggleFullScreen = (full_screen_ref) => {

        if (!document.fullscreenElement) {

            full_screen_ref.current.requestFullscreen().catch((err) => {
                alert(
                    `Error attempting to enable fullscreen mode: ${err.message} (${err.name})`,
                );
            });
        } else {
            document.exitFullscreen();
        }
    }

    // define useReducer state;
    const [state, dispatch] = useReducer(reducer, {
        zoom: 95,
        page_no: 1, // 
        no_of_pages: 1, // h
        is_full_screen: false
    })
    const full_screen_ref = useRef(null);
    var acc_no = document.getElementById("accession_no").value;
    var title = document.getElementById("title").value;
    var author = document.getElementById("author").value;
    const pages = Array.from({ length: 20 }, (value, index) => index + 1);

    //hello
    // acc_no --->> used in --->> {cover_page, pages}
    // pages -->> REFACTOR ---> done for now

    return (
        <div className="EbookReader">
            <LeftPanel acc_no={acc_no} title={title} author={author} />
            <div className="EbookReader right-panel" ref={full_screen_ref}>
                <Controls page_no={state.page_no}
                    prev={() => { if (state.page_no > 1) dispatch({ type: "prev" }) }}
                    next={() => { if (state.page_no < pages.length) dispatch({ type: `next#${pages.length}` }) }}
                    handle_zoom_in={() => { if (state.zoom < 250) dispatch({ type: "zoom-in" }) }}
                    handle_zoom_out={() => { if (state.zoom > 60) dispatch({ type: "zoom-out" }) }}
                    handle_select_single_page={() => { if (state.no_of_pages !== 1) dispatch({ type: "select-page-single" }) }}
                    handle_select_double_page={() => { if (state.no_of_pages !== 2) dispatch({ type: "select-page-double" }) }}
                    change_full_screen={() => toggleFullScreen(full_screen_ref)}
                    state={state} />
                <BookDisplay pages={pages} page_no={state.page_no} layout={state.no_of_pages} zoom={state.zoom} acc_no={acc_no} />
            </div>
        </div>
    )
}

function LeftPanel({ acc_no, title, author }) {
    return (
        <div className="EbookReader LeftPanel">
            <img className="book-thumbnail" src={`/images/book_reader/covers/${acc_no}.jpg`} />
            <div className="font-title">{title.replaceAll("#", " ")}</div>
            <div className="font-author">by - {author.replaceAll("#", " ")}</div>
            <button className="get-details">Get Details</button>
        </div>

    )

}

function Controls(props) {
    // var swipe_right = props.swipe_right;
    // var 
    var page_no = props.page_no
    // props -> page_no, prev, next, handle_zoom_in, handle_zoom_out, handle_select_single_page, handle_select_double_page, state
    return (
        <div className="Controls">
            <div className="controls-left">
                <div className="btn-grp">
                    <button className="btn font-controls" >{`Zoom: ${props.state.zoom}%`}</button>    </div>
                <div className="btn-grp">
                    <button className="btn" onClick={props.handle_zoom_out}><img className="icon" src="/images/book_reader/icons/zoom-out.png" /></button>
                    <button className="btn" onClick={props.handle_zoom_in}><img className="icon" src="/images/book_reader/icons/zoom-in.png" /></button>  </div>
                <div className="btn-grp">
                    <button className="btn" onClick={props.handle_select_single_page}><img className="icon" src="/images/book_reader/icons/single-page-layout-fold.png" /></button>
                    <button className="btn" onClick={props.handle_select_double_page}><img className="icon" src="/images/book_reader/icons/double-page-layout.png" /></button>    </div>
                <div className="btn-grp">
                    <button className="btn" onClick={props.change_full_screen}><img className="icon" src="/images/book_reader/icons/fullscreen.png" /></button>   </div>




            </div>
            <div className="controls-right">
                <div className="btn-grp">
                    <button className="btn font-controls">Page {props.page_no}</button>   </div>
                <div className="btn-grp">
                    <button className="btn" onClick={props.prev}><img className="icon" src="/images/book_reader/icons/prev.png" /></button>
                    <button className="btn" onClick={props.next}><img className="icon" src="/images/book_reader/icons/next.png" /></button>  </div>
                <div className="btn-grp">
                    <button className="btn" disabled={true}><img className="icon" src="/images/book_reader/icons/download.png" /></button>
                    <button className="btn" disabled={true}><img className="icon" src="/images/book_reader/icons/print.png" /></button>   </div>
            </div>
        </div>
    )

}

function BookDisplay({ pages, page_no, layout, zoom, acc_no }) {
    // format of pages -> [1, 2, 3, ....., 10]
    console.log(pages[parseInt(page_no)])
    console.log(page_no)
    var tmp_list = (layout === 1) ? [page_no] : [page_no, page_no + 1]
    var display_list = tmp_list.map(p_no => {
        const params = new URLSearchParams({
            'id': 'get-pdf-page',
            'acc_no': acc_no,
            'page_no': pages[p_no-1]
        });
        var url = window.location.origin;
        var new_url = `${url}/?${params}`
        var style = { height: `${zoom}%`, width: "auto" }
        const __key = pages[p_no - 1]
        if (p_no > pages.length) {
            return (<img key={__key} className="page" src="/images/book_reader/blank_page.jpg" style={style} />)
        }
        // else return (<img className="page" src={`/images/book_reader/pages/${acc_no}/${pages[p_no - 1]}.jpg`} style={style} />)
        // else return (<Img_fetch key={__key} url='/' style={style} acc_no={acc_no} page_no={pages[p_no - 1]} />)
        else return (<img key={__key} className='page' src={new_url} style={style} />)
    })

    return (
        <div className="BookDisplay">
            {/* <iframe className="pdf" src="./one.pdf" width="800" height="90%"></iframe> */}
            {display_list}
        </div>
    )
}

/*
function Img_fetch({ url, style, acc_no, page_no }) {
    const [imageUrl, setImageUrl] = useState(null);
    const params = new URLSearchParams({
        'id': 'get-pdf-page',
        'acc_no': acc_no,
        'page_no': page_no
    });

    var new_url = `${url}?${params}`


    useEffect(() => {
        fetch(new_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
        })
            .then(response => response.blob())
            .then(blob => setImageUrl(URL.createObjectURL(blob)));
    }, []);

    return (
        imageUrl && <img src={imageUrl} className='page' style={style} />
    )
}

*/

function BloodyImage({ url, style }) {
    return (
        <img src={url} className='page' style={style} />
    )
}

export default EbookReader;