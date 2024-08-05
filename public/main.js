
let itemsCon = document.getElementById("items-con");
let productsCon = document.getElementById("productsContent")
let rightArrow = document.getElementById("rightArrow");
let leftArrow = document.getElementById("leftArrow");
let itemId = 0;


function addItemTo(id, imgSource, description, price, where){
    imgSource = imgSource.substring(3);
    where == itemsCon ? itemId++ : 0;

    let box = document.createElement('DIV');
    box.className = 'box';
    
    let itemDescription = document.createElement("P");
    itemDescription.className = 'description';
    itemDescription.textContent = description;
    box.appendChild(itemDescription);
    
    let itemPrice = document.createElement("P");
    itemPrice.className = 'price';
    itemPrice.textContent = price;
    box.appendChild(itemPrice);

    let img = document.createElement("IMG");
    img.src = imgSource;

    let imgCon = document.createElement("DIV");
    imgCon.className = 'image-con';
    imgCon.appendChild(img);

    let item = document.createElement("DIV");
    item.className = 'item';
    item.id = `item${itemId}`;
    item.appendChild(imgCon);
    item.appendChild(box);
    item.onclick = function(){
        window.location.href = "public/product.php?id=" + id;
    }

    where.appendChild(item);
}




$.ajax({
    url: "functions/get_clothes.php",
    method: "get",
    success: (data) => {
    showItems(JSON.parse(data));
    }
})

let items;
let lastId;

function showItems(Allitems){
    Allitems.forEach(item => {
        addItemTo(item.id, item.img, item.title, item.price, itemsCon);
        addItemTo(item.id, item.img, item.title, item.price, productsCon);
    });
    items = document.querySelectorAll(".latest .item");
    lastId = itemId - 1;
}


rightArrow.onclick = function(){
    arrowsBlock();
    items[lastId].classList.add("opacity-0");
    setTimeout(() => {
        items[0].before(items[lastId]);
        items = document.querySelectorAll(".latest .item");
        items[0].classList.add("hide");
        
    }, 200);
    setTimeout(() => {
        items[0].classList.add("move");
        for(let i = 1; i < items.length; i++){
            items[i].classList.add("moving");
            items[0].classList.remove("opacity-0");
        }
    }, 300);
    setTimeout(() => {
        items[0].classList.remove("move");
        items[0].classList.remove("hide");
        for(let i = 1; i < items.length; i++){
            items[i].classList.remove("moving");
        }
    }, 700);
}


// we put the first item in the end of the list

leftArrow.onclick = function(){
    arrowsBlock();
    setTimeout(() => {
        for(let i = 0; i < items.length; i++){
            items[i].classList.add("lmoving");
        }
        
    }, 300);
    setTimeout(() => {
        items[lastId].after(items[0]);
        items = document.querySelectorAll(".latest .item");
        for(let i = 0; i < items.length; i++){
            items[i].classList.remove("lmoving");
        }
    }, 700);
}


function arrowsBlock(){
    rightArrow.classList.add("block");
    leftArrow.classList.add("block");
    setTimeout(() => {
        rightArrow.classList.remove("block");
        leftArrow.classList.remove("block");
    }, 1000);
}