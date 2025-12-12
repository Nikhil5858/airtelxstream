AirtelXstream OTT Platform – Database System

A fully-designed and production-ready OTT Platform Database System inspired by AirtelXstream.
This project includes a complete MySQL schema, real movie metadata, user authentication tables, subscription engine, cast management, watchlist, seasons & episodes, and full relational mapping with foreign keys.

The purpose of this project is to demonstrate strong skills in database design, SQL normalization, OTT content modeling, and backend-ready structure.

📌 Features

This DB system includes all major components required for a real OTT service:

1. User Management

User profiles

Email login & OTP-based authentication

Track last login

Subscription status

2. OTP Authentication

Stores OTPs

OTP expiration timestamp

Linked to users

Secure login workflow support

3. Movies & Web Series

Mixed collection of Hollywood, Bollywood, Tollywood & Korean cinema

Real titles, descriptions, genres

Poster, banner, movie URL, trailer URL

Flags for featured, free, new release, banner content

4. Genre Mapping

10 predefined genres

Strong relational mapping to Movies

5. OTT Platform Providers

Supports multiple OTT providers like:
Netflix, Amazon Prime, Hotstar, SonyLIV, Zee5, JioCinema, Hulu, HBO Max, Apple TV+

6. Watchlist

Users can add movies to watchlist

Track watchlist entries

7. Subscriptions

Monthly & yearly plans

Payment tracking (UPI, Card, NetBanking)

Auto-renew functionality

8. Web Series (Optional)

Seasons & Episodes tables

Structured hierarchy

Linked with movies

9. Cast & Roles

Real cast names

Actor–movie relationship

Role mapping (Lead, Supporting, Antagonist, etc.)

📂 Database Schema Overview
Tables Included

users

user_otp

genres

ott_providers

movies

watchlist

seasons

episodes

subscription

user_subscription

cast_table

cast_roles

cast_content

This schema uses:

Foreign keys for relational integrity

Auto-increment primary keys

Normalized structure (3NF+)

No redundant data
