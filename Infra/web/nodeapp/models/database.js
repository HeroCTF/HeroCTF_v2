const mongoose = require('mongoose');
const { Schema } = mongoose;

const host = "mongodb";
const dbUser = "root";
const dbPassword = "p4ssw0rd";
const dbName = "admin";

mongoose.connect(`mongodb://${dbUser}:${dbPassword}@${host}:27017/${dbName}`, {useNewUrlParser: true, useUnifiedTopology: true});

const userSchema = new Schema({
    username: String,
    password: String
});

const User = mongoose.model("User", userSchema);

const admin = new User({
    username: "admin",
    password: "5d41402abc4b2a76b9719d911017c592"
});
  
admin.save((err) => {
    if (err) return console.log(err);
    console.log("Admin saved !");
});

module.exports = User;