export const pageScrollState = (() => {
    let pageScrollPosition = 0;
    const fix = () => {
        if(!document.body.parentElement.classList.contains('fixed')){
            pageScrollPosition = window.scrollY;
            document.body.parentNode.classList.add('fixed');
            document.body.scrollTop = pageScrollPosition;
        }
    };
    const unfix = () => {
        if(document.body.parentElement.classList.contains('fixed')) {
            document.body.parentNode.classList.remove('fixed');
            window.scrollTo(0, pageScrollPosition);
        }
    };
    const toggle = () => {
        document.body.parentNode.classList.contains('fixed') ? unfix() : fix();
    };
    const set = (position) => {
        window.scrollTo(0, position);
    };
    return {
        fix,
        unfix,
        toggle,
        set,
    };
})();