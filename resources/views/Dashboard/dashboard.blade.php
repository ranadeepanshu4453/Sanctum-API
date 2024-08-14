<div>
    <h1>
        Welcome To Dashboard
        <h3>Add New Article here</h3>
        <form action="/addArticle" method="post">
            @csrf
            <input type="text" name="title" placeholder="Enter Title"><br><br>
            <input type="text" name="description" placeholder="Enter Description"><br><br>
            <button>Submit</button>
        </form>
    </h1>
</div>