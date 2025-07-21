@extends('layouts.publicLayouts.app')

@section('content')

    <style>
        /* CSS code */
        body {
            background-color: white;
            color: #fff;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .free-resources {
            padding: 20px;
        }

        .free-resources h1 {
            margin-bottom: 20px;
        }

        .free-resources p {
            margin-bottom: 20px;
        }

        .resource-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .resource-buttons button {
            background-color: #e0e0e0;
            border: none;
            border-radius: 5px;
            color: #000;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .resource-buttons button:hover {
            background-color: #d0d0d0;
        }
    </style>

    <div class="free-resources">
        <h1>Polity Free Resources</h1>
        <p>This page provides access to complimentary resources designed to support your learning journey. These resources are synchronized with Abhigyan Academy's YouTube videos and are organized for your convenience. To optimize your learning experience, please view the corresponding YouTube videos before downloading any resources. Enjoy your studies!</p>
        <div class="container">
            
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1wthmVXzXsz2TXC12JlnlZFRkIBmnGeVu/view?usp=drive_link">Class 1</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1VX5LtG8ix6BNQ7KgCMTNXGU-VzWvMP43/view?usp=drive_link">Class 2</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1ahucC2K5OU2AmqJXSD_5NdZGQj-jtWSs/view?usp=drive_link">Class 3</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1VID88ZkzKBvvnYT2N1EdwiImKNK4fRUE/view?usp=drive_link">Class 4</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1PC7MK6YYCIIVGAgw3GOZLukaJ8LjkzBh/view?usp=drive_link">Class 5</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/16jvCB-hgoVXQ5EQ7FBBkxTxcBBcXRyEN/view?usp=drive_link">Class 6</a>

        </div>
    </div>
    
    
@endsection
