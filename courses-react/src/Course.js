import React, { Component } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import { Container, Row, Card } from "react-bootstrap";
import "./Course.css";
import defaultImage from "./img/course.jpg";

class Course extends Component {
  constructor() {
    super();
    this.state = {
      courses: [],
    };
  }

  componentDidMount() {
    axios
      .get("http://localhost:8000/courses")
      .then((response) => {
        this.setState({
          courses: response.data,
        });
      })
      .catch((error) => {
        console.log(error);
      });
  }
  render() {
    return (
      <Container>
        <Row>
          {this.state.courses.map((course, index) => (
            <div className="col-md-3">
              <Card className= "card"key={index}>
                <Card.Img className="profile" src={defaultImage}></Card.Img>
                <Card.Title className="title">{course.name}</Card.Title>
                <Card.Text>{course.description}</Card.Text>
              </Card>
            </div>
          ))}
        </Row>
      </Container>
    );
  }
}

export default Course;
