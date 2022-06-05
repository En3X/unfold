tagArray = [];
tag = document.querySelector("#posttag");
tag.addEventListener('keydown',(e)=>{
    if (e.key == " ") {
        if (tag.value != " ") {
            newTag = tag.value.toLowerCase();
            if (tagArray.includes(newTag)) {
                tag.value="";
                return;
            }else{
                tagArray.push(newTag);
                tagDiv = document.createElement('div');
                tagDiv.classList = "tag kregular";
                tagDiv.textContent = newTag;
                tagDiv.setAttribute('onclick','removeTag(this)');
                document.querySelector("#tagSection").prepend(tagDiv);
            }
        }
        tag.value="";
    }
});

tag.addEventListener('input',()=>{
    if(tag.value == " "){
        tag.value="";
    }
})

function removeTag(tag){
    tagValue = tag.textContent;
    tag.remove();
    index = tagArray.indexOf(tagValue);
    tagArray.splice(index,1);
}

decoyBtn = document.querySelector('#decoySubmit');
decoyBtn.addEventListener('click',()=>{
    if (tagArray.length > 0) {
        finalTag = "";
        tagArray.forEach(tag => {
            if (finalTag == "") {
                finalTag += tag;
            }else{
                finalTag += ","+tag;
            }
        });
        console.log(finalTag);
        document.querySelector("#finalTags").value = finalTag;
    }

    document.querySelector("#makePost").click();

})


