
#ifdef _MSC_VER
#define _CRT_SECURE_NO_WARNINGS
#endif

#ifndef assign1_h	
#define assign1_h


#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "stack.h"


typedef struct {
	char *request;
	int *plate;
	int *moveNum;
}CAR;


void arrival(CAR* car, STACK* garage, STACK* temp);
void departure(CAR* car, STACK* garage, STACK* temp);

#endif

