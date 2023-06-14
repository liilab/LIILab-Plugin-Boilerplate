import React, { useState, useEffect } from "react";
import "./index.css";
import UserCard from "./Components/UserCard";
import axios from "axios";
import { UserInfo, UserinfoShortcodeAttributes } from "../shared/Types";

export default function App(props: UserinfoShortcodeAttributes) {
  const { id } = props;

  const [userInfo, setUserInfo] = useState<UserInfo>({ id: "" , name: "", email: "", occupation: "", avatar: ""});

  useEffect(() => {
    axios
      .get(
        "http://localhost/wordpress1/wp-json/liilab-plugin-boilerplate/v1/user-info/" +
          id
      )
      .then((response) => {
        setUserInfo(response.data);
      })
      .catch((error) => {
        console.log(error);
      });
  }, []);

  return (
    <>
      <UserCard {...userInfo} />
    </>
  );
}
