const hero = document.querySelector('.hero');

if (hero) {
    const track = hero.querySelector('.hero-track');
    const dots  = hero.querySelectorAll('.hero-dot');
    const total = hero.querySelectorAll('.slide').length;   

    
    const firstCopy = track.querySelector('.slide').cloneNode(true);   
    track.appendChild(firstCopy);

    let current = 0;
    let timer   = null;

    // Move with animation
    function show() {
        track.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach(d => d.classList.remove('active'));
        dots[current % total].classList.add('active');      
    }

    // Move instantly, with no animation (the invisible jump)
    function jump(index) {
        track.style.transition = 'none';
        current = index;
        track.style.transform = `translateX(-${current * 100}%)`;
        track.offsetWidth;                 // forces the browser to apply the jump right now
        track.style.transition = '';       // turn animation back on for the next move
    }

    function next() {
        if (current === total) jump(0);    // sitting on the copy? snap to the real slide 1 first
        current++;
        show();
    }

    function prev() {
        if (current === 0) jump(-1);     // hint: snap to the copy at the END, then glide back to 4
        current--;
        show();
    }

    function goTo(i) {
        if (current === total) jump(total);
        current = i;
        show();
    }

    // 2. When a glide lands on the copy, swap to the real slide 1 invisibly
    track.addEventListener('transitionend', () => {
        if (current === total) jump(0);
    });

    function startAuto() {
        clearInterval(timer);
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        timer = setInterval(next, 3000);
    }

    hero.querySelector('.hero-next').addEventListener('click', () => { next(); startAuto(); });
    hero.querySelector('.hero-prev').addEventListener('click', () => { prev(); startAuto(); });
    dots.forEach((dot, i) => dot.addEventListener('click', () => { goTo(i); startAuto(); }));

    hero.addEventListener('mouseenter', () => clearInterval(timer));
    hero.addEventListener('mouseleave', startAuto);

    startAuto();
}