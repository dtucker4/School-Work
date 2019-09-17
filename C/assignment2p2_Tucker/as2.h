#pragma once
#ifndef as2_h
#define as2_h
#include <stdio.h>
#include <string.h>
#include <stdbool.h>
#include <stdlib.h>
#include "List.h"
int cmpScore(void* pName1, void* pName2);
void insertScores(LIST* list);
#endif