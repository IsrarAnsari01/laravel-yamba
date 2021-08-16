let express = require("express");
let app = express();
const bodyParser = require("body-parser");
const port = 6000;
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json({ limit: "40mb" }));
app.use("/user", require("./module/routes/user.routes"));
app.use("/post", require("./module/routes/post.routes"));
app.get("*", (req, res) => {
  res.send("<h2> Welcome to test Server</h2>");
});

app.listen(port, (err) => {
  if (err) {
    console.log("Error in listening at " + port);
    console.log(err);
    return;
  }
  console.log("Server Started Successfully..!");
});
